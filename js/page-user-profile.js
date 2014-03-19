// Edit profile
var userProfileEdit          = document.getElementById('user-profile-edit');
var userProfileUsername      = document.getElementById('user-profile-username');
var userProfileLocation      = document.getElementById('user-profile-location');
var userProfileLocationInput = document.getElementById('user-profile-location-input');
var userProfileFacebookInput = document.getElementById('user-profile-facebook-input');
var userProfileTwitterInput  = document.getElementById('user-profile-twitter-input');

var editing = false;
var userProfileUsernameCurrent = userProfileUsername.innerHTML;
var userProfileLocationCurrent = userProfileLocation.innerHTML;
var href = userProfileFacebookInput.previousSibling.href.split('/');
var userProfileFacebookCurrent = href[href.length - 1];
var href = userProfileTwitterInput.previousSibling.href.split('/');
var userProfileTwitterCurrent  = href[href.length - 1];

userProfileEdit.addEventListener('click', function(e) {
    if(editing) {
        // Save
        // Only send the request if something has changed
        if(userProfileLocationInput.value == userProfileLocationCurrent && userProfileFacebookInput.value == userProfileFacebookCurrent && userProfileTwitterInput.value == userProfileTwitterCurrent) {
            resetForm();
        } else {
            var data = 'location=' + userProfileLocationInput.value + '&facebook=' + userProfileFacebookInput.value + '&twitter=' + userProfileTwitterInput.value;
            var request = new XMLHttpRequest;
            request.open('POST', '/php/saveUserProfile.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.send(data);

            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    resetForm();
                    location.reload();
                }
            }

            request.onerror = function() {
                alert('Something went wrong. Please try again.');
            };
        }

        function resetForm() {
            editing = false;
            e.target.firstChild.className = 'ico-edit';

            // Reinstate username
            userProfileUsername.innerHTML = userProfileUsernameCurrent;

            // Hide input fields
            userProfileLocationInput.className += ' user-profile-input--hidden';
            userProfileFacebookInput.className += ' user-profile-input--hidden';
            userProfileTwitterInput.className  += ' user-profile-input--hidden';
        }
    } else {
        // Edit
        editing = true;
        e.target.firstChild.className = 'ico-save';

        // Show link to Gravatar
        userProfileUsername.innerHTML = '<a href="http://gravatar.com/" target="_blank" title="Change your avatar at Gravatar.com"><i class="ico-edit"></i>Gravatar.com</a>';

        // Show input fields
        userProfileLocationInput.className = userProfileLocationInput.className.replace(' user-profile-input--hidden', '');
        userProfileFacebookInput.className = userProfileFacebookInput.className.replace(' user-profile-input--hidden', '');
        userProfileTwitterInput.className  = userProfileTwitterInput.className.replace(' user-profile-input--hidden', '');

        // If location has already been entered, put it into the input field
        if(userProfileLocation.innerHTML != 'No location details') {
            userProfileLocationInput.value = userProfileLocationCurrent;
        }

        // If Facebook/Twitter usernames have already been entered, put them into the input fields
        if(userProfileFacebookInput.previousSibling.href.slice(-1) != '#') {
            userProfileFacebookInput.value = userProfileFacebookCurrent;
        }

        if(userProfileTwitterInput.previousSibling.href.slice(-1) != '#') {
            userProfileTwitterInput.value = userProfileTwitterCurrent;
        }
    }
});


// Delete environment
var envDelete = document.querySelectorAll('.env-delete');

for(var i = 0; i < envDelete.length; i++) {
    envDelete[i].addEventListener('click', deleteEnvironment);
}

function deleteEnvironment(e) {
    e.preventDefault();

    var envName = e.target.parentNode.getElementsByTagName('h1')[0].innerHTML;
    var confirm = window.confirm('Are you sure you want to delete environment: ' + envName + '?');

    if(confirm) {
        var url         = e.target.parentNode.parentNode.href;
        var index       = url.lastIndexOf('/');
        var envDeleteId = url.substr(index + 1);

        var data = 'envDeleteId=' + envDeleteId;
        var request = new XMLHttpRequest;
        request.open('POST', '/php/deleteEnv.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                location.reload();
            } else if(request.status != 200) {
                alert('An error has occurred. Please try again.');
            }
        }
    }
}