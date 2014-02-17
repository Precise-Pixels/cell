<main>
    <header class="section-padding align-centre dgrey">
        <hgroup class="align-vertical">
            <h1>CLONE A NEW ENVIRONMENT</h1>
        </hgroup>
    </header>

    <section class="align-centre">
        <div class="section-padding half lgrey">
            <h1>INSTRUCTIONS</h1>
            <p>Using the map below, zoom in fully then select the division of the planet you wish to clone.</p>
        </div>
        <div class="section-padding half sdgrey">
            <h1>WHY ARE YOU HERE?</h1>
            <p>Using the map below, zoom in fully then select the division of the planet you wish to clone.</p>
        </div>
    </section>

    <section class="align-centre section--spacer">
    </section>

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
                        <td><input type="text" name="env-name" required autofocus/></td>
                        <td><input type="submit" id="generate-btn" name="clone" value="CLONE" class="btn"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</main>