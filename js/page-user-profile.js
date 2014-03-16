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