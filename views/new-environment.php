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
            <ol>
                <li class="third">
                    <h1>1</h1>
                    <img src="/img/new-env-instructions-1.png" class="scale">
                    <p>Select an area on the map</p>
                </li>
                <li class="third">
                    <h1>2</h1>
                    <img src="/img/new-env-instructions-2.png" class="scale">
                    <p>Click the clone button</p>
                </li>
                <li class="third">
                    <h1>3</h1>
                    <img src="/img/new-env-instructions-3.png" class="scale">
                    <p>View your cloned environment</p>
                </li>
            </ol>
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

    <section class="align-centre sdgrey">
        <section class="section-content-wrapper">
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
        </section>
        
        <section class="section-content-wrapper">
            <a href="technology" class="cta cta--example half">
                <hgroup class="align-vertical">
                    <h1>Project Titan</h1>
                </hgroup>
            </a>
            <a href="technology" class="cta cta--example half">
                <hgroup class="align-vertical">
                    <h1>The Process</h1>
                </hgroup>
            </a>
        </section>
    </section>

</main>