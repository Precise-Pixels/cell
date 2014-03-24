<?php

class LoginSystem {
    const wrapStart = '<p class="full warn">';
    const wrapEnd   = '</p>';

    static function signin($email, $password) {
        require_once('db.php');
        require_once('Encryption.php');

        $passwordE  = Encryption::encrypt($password);

        $sth = $dbh->query("SELECT userId, password, valid, username FROM users WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $row = $sth->fetch();

        if($row) {
            if($row->valid == 1) {
                if($row->password === $passwordE) {
                    require_once('User.php');

                    $_SESSION['status']    = 'signedin';
                    $_SESSION['userEmail'] = $email;
                    $_SESSION['userId']    = $row->userId;
                    $_SESSION['username']  = $row->username;

                    header("location: /user/{$_SESSION['username']}");

                } else {
                    return LoginSystem::wrapStart . 'Wrong email and/or password.' . LoginSystem::wrapEnd;
                }
            } else {
                return LoginSystem::wrapStart . 'Please verify your account by clicking the verification link in your email before attempting to log in. If you have not receive a verification email, please check your spam/junk or <a href="resend-validation-email">request another verification email</a>.' . LoginSystem::wrapEnd;
            }
        } else {
            return LoginSystem::wrapStart . 'Wrong email and/or password.' . LoginSystem::wrapEnd;
        }
    }

    static function signout() {
        unset($_SESSION['status']);
        unset($_SESSION['userEmail']);
        unset($_SESSION['userId']);
        unset($_SESSION['username']);
        (isset($_GET['r']) ? header("location:" . $_GET['r']) : header('location: /'));
    }

    static function createUser($email, $password, $username) {
        require('db.php');
        require_once('Encryption.php');
        require_once('MailClient.php');

        $passwordE  = Encryption::encrypt($password);

        $rand1 = LoginSystem::generateRandomNumber();
        $rand2 = LoginSystem::generateRandomNumber();

        $timestamp = date("Y-m-d H:i:s");

        $sth = $dbh->prepare("INSERT INTO users (email, password, valid, validateRand, resetRand, timestamp, username, location, facebook, twitter) value (:email, :password, 0, $rand1, $rand2, :timestamp, :username, '', '', '')");
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $passwordE);
        $sth->bindParam(':timestamp', $timestamp);
        $sth->bindParam(':username', $username);
        $sth->execute();

        MailClient::sendMsg($email, 'Verify your MyCell account', "Please follow this link to verify your MyCell account: http://cell-industries.co.uk/verify-account?e=$email&r=$rand1");

        return LoginSystem::wrapStart . 'Account successfully created. We have sent a verification link to your email. Please verify your account before attempting to sign in. If you have not receive a verification email, please check your spam/junk or <a href="resend-validation-email">request another verification email</a>.' . LoginSystem::wrapEnd;
    }

    static function resendValidationEmail($email) {
        require('db.php');
        require_once('MailClient.php');

        $rand = LoginSystem::generateRandomNumber();

        $sth = $dbh->prepare("UPDATE users SET validateRand='$rand' WHERE email='$email'");
        $sth->execute();

        MailClient::sendMsg($email, 'Verify your MyCell account', "Please follow this link to verify your MyCell account: http://cell-industries.co.uk/verify-account?e=$email&r=$rand");

        return LoginSystem::wrapStart . 'We have sent a verification link to your email. Please verify your account before attempting to sign in.' . LoginSystem::wrapEnd;
    }

    static function validateUser($email, $rand) {
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

    static function checkUserExists($email, $username) {
        require('db.php');

        $sth = $dbh->query("SELECT email, username FROM users WHERE email='$email' OR username='$username'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return (!$result ? false : true);
    }

    static function sendResetPasswordLink($email) {
        require('db.php');
        require_once('MailClient.php');

        $rand = LoginSystem::generateRandomNumber();

        $sth = $dbh->prepare("UPDATE users SET resetRand='$rand' WHERE email='$email'");
        $sth->execute();

        MailClient::sendMsg($email, 'Reset your MyCell account password', "Please follow this link to reset your MyCell account password: http://cell-industries.co.uk/reset-password?e=$email&r=$rand");

        return LoginSystem::wrapStart . 'We have sent instructions on how to reset your password to your email. Please check your emails.' . LoginSystem::wrapEnd;
    }

    static function resetPassword($email, $password, $rand) {
        require('db.php');

        $sth = $dbh->query("SELECT resetRand FROM users WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        if($result->resetRand == $rand) {
            require_once('Encryption.php');

            $passwordE = Encryption::encrypt($password);

            $newRand = LoginSystem::generateRandomNumber();

            $sth = $dbh->prepare("UPDATE users SET password='$passwordE', resetRand='$newRand' WHERE email='$email'");
            $sth->execute();

            return LoginSystem::wrapStart . 'Password successfully reset. Please <a href="signin">sign in</a>.' . LoginSystem::wrapEnd;
        } else {
            return LoginSystem::wrapStart . 'This link has expired. Please <a href="forgotten-password">request a new password reset link</a>.' . LoginSystem::wrapEnd;
        }
    }

    static function generateRandomNumber() {
        return rand(pow(10, 6-1), pow(10, 6)-1);
    }
}