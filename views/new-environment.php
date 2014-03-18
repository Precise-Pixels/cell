<?php
    if(!isset($_SESSION['status'])) {
        $_SESSION['status'] = 'notsignedin';
        header('location: /signin');
    }
?>
<header id="fixed-header" class="fixed-header--newenv section-padding">
    <hgroup class="align-vertical">
        <h1>CLONE AN ENVIRONMENT</h1>
    </hgroup>
</header>

<main>

    <section class="full">
        <div class="align-centre sdgrey">
            <p><i class="ico-info"></i>Zoom in fully to select an area to clone!</p>
        </div>
    </section>

    <section id="new-env-interface" class="sdgrey">
        <div class="unsupported">
            <hgroup class="align-vertical">
                <h1>Your browser does not support the cloning process</h1>
            </hgroup>
        </div>

        <script type="text/x-new-env-interface-markup" id="new-env-interface-markup">
            <div class="align-centre mblue">
                <input type="text" placeholder="Search Box" id="pac-input" class="controls">
                <div id="new-env-map"></div>

                <div id="new-env-form" class="section-padding mblue">
                    <img src="/img/tile-select.jpg" id="selected-tile"/>
                    <form method="POST">
                        <table>
                            <tr>
                                <td><label for="env-name">Your Environment Name:</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="new-env-name" id="new-env-name" maxlength="30" required/></td>
                                <td><input type="button" id="clone-btn" value="CLONE" class="btn"/></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </script>
    </section>

    <section class="dgrey align-centre">
        <ol class="align-centre">
            <li class="third">
                <h1>1</h1>
                <img src="/img/new-env-instructions-1.png" class="scale">
                <p>Zoom in fully to select an area of the map</p>
            </li>
            <li class="third">
                <h1>2</h1>
                <img src="/img/new-env-instructions-2.png" class="scale">
                <p>Name your environment and click the clone button</p>
            </li>
            <li class="third">
                <h1>3</h1>
                <img src="/img/new-env-instructions-3.png" class="scale">
                <p>View your newly cloned environment</p>
            </li>
        </ol>
    </section>

    <section class="align-centre sdgrey">   
        <section class="section-content-wrapper">
            <a href="/project-titan" class="cta cta--pt-small half">
                <hgroup class="align-vertical">
                    <h1>Project Titan</h1>
                    <h2>Discover the groundbreaking project</h2>
                </hgroup>
            </a>
            <a href="/recently-cloned-environments" class="cta cta--recent half">
                <hgroup class="align-vertical">
                    <h1>Recently Cloned</h1>
                    <h2>See the most recently cloned environments</h2>
                </hgroup>
            </a>
        </section>
    </section>

</main>

<div id="full-page-overlay--loading" class="full-page-overlay"></div>