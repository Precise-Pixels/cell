<?php

class LoginSystem {
    private $wrapStart = '<p class="full warn">';
    private $wrapEnd   = '</p>';

    function signin($email, $password) {
        require_once('db.php');
        require_once('php/Encryption.php');

        $encryption = new Encryption;
        $passwordE  = $encryption->encrypt($password);

        $sth = $dbh->query("SELECT userId, password, valid, username FROM users WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $row = $sth->fetch();

        if($row) {
            if($row->valid == 1) {
                if($row->password === $passwordE) {
                    require_once('User.php');
                    $user = new User;
                    $userHandle = $user->getUserHandle($row->userId);

                    $_SESSION['status']    = 'signedin';
                    $_SESSION['userEmail'] = $email;
                    $_SESSION['userHandle']  = $userHandle;

                    header("location: /user/{$_SESSION['userHandle']}");

                } else {
                    return $this->wrapStart . 'Wrong email and/or password.' . $this->wrapEnd;
                }
            } else {
                return $this->wrapStart . 'Please verify your account by clicking the verification link in your email before attempting to log in. If you have not receive a verification email, please check your spam/junk or <a href="resend-validation-email">request another verification email</a>.' . $this->wrapEnd;
            }
        } else {
            return $this->wrapStart . 'Wrong email and/or password.' . $this->wrapEnd;
        }
    }

    function signout() {
        unset($_SESSION['status']);
        unset($_SESSION['userEmail']);
        unset($_SESSION['userHandle']);
        (isset($_GET['r']) ? header("location:" . $_GET['r']) : header('location: /'));
    }

    function createUser($email, $password) {
        require('db.php');
        require_once('php/Encryption.php');
        require_once('php/MailClient.php');

        $encryption = new Encryption;
        $passwordE  = $encryption->encrypt($password);

        $rand1 = $this->generateRandomNumber();
        $rand2 = $this->generateRandomNumber();

        $sth = $dbh->prepare("INSERT INTO users (email, password, valid, validateRand, resetRand) value (:email, :password, 0, $rand1, $rand2)");
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $passwordE);
        $sth->execute();

        $mailClient = new MailClient();
        $mailClient->sendMsg($email, 'Verify your MyCell account', "Please follow this link to verify your MyCell account: http://cell.dev/verify-account?e=$email&r=$rand1");

        return $this->wrapStart . 'Account successfully created. We have sent a verification link to your email. Please verify your account before attempting to sign in. If you have not receive a verification email, please check your spam/junk or <a href="resend-validation-email">request another verification email</a>.' . $this->wrapEnd;
    }

    function resendValidationEmail($email) {
        require('db.php');
        require_once('php/MailClient.php');

        $rand = $this->generateRandomNumber();

        $sth = $dbh->prepare("UPDATE users SET validateRand='$rand' WHERE email='$email'");
        $sth->execute();

        $mailClient = new MailClient();
        $mailClient->sendMsg($email, 'Verify your MyCell account', "Please follow this link to verify your MyCell account: http://cell.dev/verify-account?e=$email&r=$rand");

        return $this->wrapStart . 'We have sent a verification link to your email. Please verify your account before attempting to sign in.' . $this->wrapEnd;
    }

    function validateUser($email, $rand) {
        require('db.php');

        $sth = $dbh->query("SELECT validateRand FROM users WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        if($result) {
            if($result->validateRand == $rand) {
                $sth = $dbh->prepare("UPDATE users SET valid=1 WHERE email='$email'");
                $sth->execute();
                return true;
            } else {
                return false;
            }
        }
    }

    function checkUserExists($email) {
        require('db.php');

        $sth = $dbh->query("SELECT email FROM users WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return (!$result ? false : true);
    }

    function sendResetPasswordLink($email) {
        require('db.php');
        require_once('php/MailClient.php');

        $rand = $this->generateRandomNumber();

        $sth = $dbh->prepare("UPDATE users SET resetRand='$rand' WHERE email='$email'");
        $sth->execute();

        $mailClient = new MailClient();
        $mailClient->sendMsg($email, 'Reset your MyCell account password', "Please follow this link to reset your MyCell account password: http://cell.dev/reset-password?e=$email&r=$rand");

        return $this->wrapStart . 'We have sent instructions on how to reset your password to your email. Please check your emails.' . $this->wrapEnd;
    }

    function resetPassword($email, $password, $rand) {
        require('db.php');

        $sth = $dbh->query("SELECT resetRand FROM users WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        if($result->resetRand == $rand) {
            require_once('php/Encryption.php');

            $encryption = new Encryption;
            $passwordE  = $encryption->encrypt($password);

            $newRand = $this->generateRandomNumber();

            $sth = $dbh->prepare("UPDATE users SET password='$passwordE', resetRand='$newRand' WHERE email='$email'");
            $sth->execute();

            return $this->wrapStart . 'Password successfully reset. Please <a href="signin">sign in</a>.' . $this->wrapEnd;
        } else {
            return $this->wrapStart . 'This link has expired. Please <a href="forgotten-password">request a new password reset link</a>.' . $this->wrapEnd;
        }
    }

    function generateRandomNumber() {
        return rand(pow(10, 6-1), pow(10, 6)-1);
    }
}