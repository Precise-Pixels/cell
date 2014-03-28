<?php
if(!isset($_COOKIE['cookiesMessage'])):
    setcookie('cookiesMessage', 'true', time()+(60*60*24*365), '/');
?>
    <div id="cookies" class="dgrey"><p><i class="ico-cross"></i>This site uses cookies. Some of the cookies we use are essential for parts of the site to operate and have already been set. You may delete and block all cookies from this site, but parts of the site will not work.</p><p><a href="/privacy-policy">Click here to learn more.</a></p></div>
    <script>var cookies = document.getElementById('cookies'); cookies.addEventListener('click', function() { cookies.className = 'cookies--hide'; });</script>
<?php endif; ?>