<?php
    if(!isset($_SESSION['status'])) {
        $_SESSION['status'] = 'notsignedin';
        header('location: /signin');
    }
?>

<main>
    <header class="section-padding align-centre dgrey">
        <hgroup class="align-vertical">
            <h1>CLONE A NEW ENVIRONMENT</h1>
        </hgroup>
    </header>

    <section class="section--spacer">
        <div class="align-centre lgrey">
            <div class="third">
                <img src="/img/new-env-instructions-lgrey-1.jpg" class="scale">
            </div>
            <div class="third">
                <img src="/img/new-env-instructions-lgrey-2.jpg" class="scale">
            </div>
            <div class="third">
                <img src="/img/new-env-instructions-lgrey-3.jpg" class="scale">
            </div>
        </div>
    </section>

    <section class="section--spacer">
        <div class="align-centre mblue">
            <div id="map-canvas"></div>
            <div id="env-form" class="mblue"> 
                <img src="/img/tile-select.jpg" id="selected-tile"/>
                <form>
                    <table>
                        <tr>
                            <td><label for="env-name">Your Environment Name:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="env-name" required/></td>
                            <td><input type="submit" id="generate-btn" name="clone" value="CLONE" class="btn"/></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </section>

    <section>
        <div class="align-centre sdgrey">
            <div class="half section-padding">
                <h1>WHY ARE YOU HERE?</h1>
                <div class="section-content-wrapper">
                    <p>You are about to be part of Project Titan, helping us to preserve the planet. Suspendisse adipiscing nunc tortor, eget accumsan tellus tincidunt at. Ut suscipit elit id tellus tincidunt, ac luctus nisi consectetur proin velit libero.</p>
                </div>
            </div>
            <div class="half section-padding sdgrey">
                <h1>HOW IT'S DONE</h1>
                <div class="section-content-wrapper">
                    <p>We send our Quantum Cell Clone Cubes from space. Praesent massa libero, rhoncus at sodales et, fringilla vitae justo. Suspendisse adipiscing nunc tortor, eget accumsan tellus tincidunt at. Ut suscipit elit id tellus tincidunt.</p>
                </div>
            </div>
            <div class="half">
                <a href="technology" class="cta cta--example">
                    <hgroup class="align-vertical">
                        <h1>Project Titan</h1>
                    </hgroup>
                </a>
            </div>
            <div class="half">
                <a href="technology" class="cta cta--example half">
                    <hgroup class="align-vertical">
                        <h1>The Process</h1>
                    </hgroup>
                </a>
                <a href="technology" class="cta cta--example half">
                    <hgroup class="align-vertical">
                        <h1>Technology</h1>
                    </hgroup>
                </a>
            </div>
        </div>
    </section>

</main>