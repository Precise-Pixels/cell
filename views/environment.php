<h1>ENV</h1>

<p><?= $env->timestamp; ?> | <?= $env->latitude; ?> | <?= $env->longitude; ?></p>

<div id="env"></div>

<video id="video" autoplay></video>
<canvas id="canvas"></canvas>
<canvas id="comp"></canvas>

<label for="brightness">dark / more sensitive</label> <input type="radio" name="brightness" style="width:100px;">
<label for="brightness">average</label> <input type="radio" name="brightness" checked style="width:100px;">
<label for="brightness">bright / less sensitive</label> <input type="radio" name="brightness" style="width:100px;">