// Edit user profile
// up == user profile
var upEdit          = document.getElementById('user-profile-edit');
var upUsername      = document.getElementById('user-profile-username');
var upLocation      = document.getElementById('user-profile-location');
var upLocationInput = document.getElementById('user-profile-location-input');
var upFacebookInput = document.getElementById('user-profile-facebook-input');
var upTwitterInput  = document.getElementById('user-profile-twitter-input');

var editing = false;
var upUsernameCurrent = upUsername.innerHTML;
var upLocationCurrent = upLocation.innerHTML;
var href              = upFacebookInput.previousSibling.href.split('/');
var upFacebookCurrent = href[href.length - 1];
var href              = upTwitterInput.previousSibling.href.split('/');
var upTwitterCurrent  = href[href.length - 1];

upEdit.addEventListener('click', function(e) {
    if(editing) {
        // Save
        // Only send the request if something has changed
        if(upLocationInput.value == upLocationCurrent && upFacebookInput.value == upFacebookCurrent && upTwitterInput.value == upTwitterCurrent) {
            resetForm();
        } else {
            var data = 'location=' + upLocationInput.value + '&facebook=' + upFacebookInput.value + '&twitter=' + upTwitterInput.value;
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
            upUsername.innerHTML = upUsernameCurrent;

            // Hide input fields
            upLocationInput.className += ' user-profile-input--hidden';
            upFacebookInput.className += ' user-profile-input--hidden';
            upTwitterInput.className  += ' user-profile-input--hidden';
        }
    } else {
        // Edit
        editing = true;
        e.target.firstChild.className = 'ico-save';

        // Show link to Gravatar
        upUsername.innerHTML = '<a href="http://gravatar.com/" target="_blank" title="Change your avatar at Gravatar.com"><i class="ico-edit"></i>Gravatar.com</a>';

        // Show input fields
        upLocationInput.className = upLocationInput.className.replace(' user-profile-input--hidden', '');
        upFacebookInput.className = upFacebookInput.className.replace(' user-profile-input--hidden', '');
        upTwitterInput.className  = upTwitterInput.className.replace(' user-profile-input--hidden', '');

        // If location has already been entered, put it into the input field
        if(upLocation.innerHTML != 'No location details') {
            upLocationInput.value = upLocationCurrent;
        }

        // If Facebook/Twitter usernames have already been entered, put them into the input fields
        if(upFacebookInput.previousSibling.href.slice(-1) != '#') {
            upFacebookInput.value = upFacebookCurrent;
        }

        if(upTwitterInput.previousSibling.href.slice(-1) != '#') {
            upTwitterInput.value = upTwitterCurrent;
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