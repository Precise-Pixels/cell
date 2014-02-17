<main>

    <!-- Generous spacing between major sections-->
    <header class="section-padding align-centre dgrey">
        <hgroup class="align-vertical">
            <h1>PAGE TITLE</h1>
            <h2>OPTIONAL TITLE</h2>
        </hgroup>
    </header>

    <section>
        <div class="section-padding align-centre lgrey">
            <h1>FLOATING SECTION</h1>
        </div>
    </section>

    <section class="mblue">
        <div class="section-padding align-centre">
            <h1>FULL BLEED SECTION</h1>
        </div>
    </section>

    <section class="section--spacer">
        <div class="section-padding align-centre lgrey">
            <h1>FLOATING SECTION WITH SPACER (MARGIN-BOTTOM)</h1>
        </div>
    </section>

    <section class="section--spacer">
        <div class="section-padding align-centre lgrey">
            <h1>FRACTIONS</h1>

            <p class="warn">If more than one type of fraction needs to be used within one section, wrap each 'section' in <code>.section-content-wrapper</code>, if not leave that div out.</p>

            <p class="warn"><code>:first-of-type</code> and <code>:last-of-type</code> are used to reset the outer margins to keep the content inline.</p>

            <div class="section-content-wrapper">
                <h2>.full</h2>
                <p class="full">Ut venenatis quis erat quis eleifend. Suspendisse varius eros nec aliquam varius. Nam at ante vestibulum ante imperdiet aliquam posuere eu dui. Etiam pellentesque lacus mauris, vel tincidunt erat vestibulum et. Duis vel mauris luctus, dapibus tortor non, euismod arcu. Proin congue elementum velit egestas ornare. Phasellus id iaculis elit, id scelerisque arcu. Nullam vehicula ultrices ipsum, in elementum justo pellentesque a.</p>
            </div>

            <div class="section-content-wrapper">
                <h2>.half-margin</h2>
                <p class="half-margin">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent massa libero, rhoncus at sodales et, fringilla vitae justo. Suspendisse adipiscing nunc tortor, eget accumsan tellus tincidunt at. Ut suscipit elit id tellus tincidunt, ac luctus nisi consectetur. Proin velit libero, faucibus sed ultricies eget, pulvinar sit amet erat. Suspendisse vel leo sit amet magna sodales tincidunt.</p>
                <p class="half-margin">Integer sit amet nibh sit amet lectus luctus placerat. Suspendisse eget arcu tortor. Fusce pretium sodales nisl et tempus. Curabitur pretium pellentesque libero. Curabitur pretium malesuada purus, id posuere neque. Donec ante metus, rutrum id lacus ut, ultricies aliquam magna.</p>
            </div>

            <div class="section-content-wrapper">
                <h2>.third-margin</h2>
                <p class="third-margin">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent massa libero, rhoncus at sodales et, fringilla vitae justo. Suspendisse adipiscing nunc tortor, eget accumsan tellus tincidunt at. Ut suscipit elit id tellus tincidunt, ac luctus nisi consectetur. Proin velit libero, faucibus sed ultricies eget, pulvinar sit amet erat. Suspendisse vel leo sit amet magna sodales tincidunt.</p>
                <p class="third-margin">Integer sit amet nibh sit amet lectus luctus placerat. Suspendisse eget arcu tortor. Fusce pretium sodales nisl et tempus. Curabitur pretium pellentesque libero. Curabitur pretium malesuada purus, id posuere neque. Donec ante metus, rutrum id lacus ut, ultricies aliquam magna.</p>
                <p class="third-margin">Donec consequat est sed eros condimentum, nec porttitor mi convallis. Sed porttitor, justo a blandit interdum, lorem nulla ullamcorper eros, sit amet convallis ipsum ligula eu lorem. Praesent elementum diam at mauris sodales, et pellentesque nibh dignissim.</p>
            </div>

            <div class="section-content-wrapper">
                <h2>.half</h2>
                <img src="/img/placeholder.gif" alt="Half width image" class="half"/>
                <img src="/img/placeholder.gif" alt="Half width image" class="half"/>
            </div>

            <div class="section-content-wrapper">
                <h2>.third</h2>
                <img src="/img/placeholder.gif" alt="Third width image" class="third"/>
                <img src="/img/placeholder.gif" alt="Third width image" class="third"/>
                <img src="/img/placeholder.gif" alt="Third width image" class="third"/>
            </div>
        </div>
    </section>

    <section class="section--spacer">
        <div class="section-padding align-centre lgrey">
            <h1>CALL TO ACTIONS</h1>

            <p class="warn">Each <code>.cta</code> will be accompanied by its own modifier (e.g <code>.cta--example</code>) where individual <code>height</code> and <code>background-image</code> styles can be set. <code>background-position: center</code> and <code>background-size: cover</code> have already been set on <code>.cta</code></p>

            <p class="warn">Transparent grey overlay is applied on top of the image using <code>:after</code> to promote reusability of the original image.</p>

            <div class="cta cta--example half">
                <hgroup class="align-vertical">
                    <h1>CTA Title</h1>
                    <h2>Optional subtitle</h2>
                </hgroup>
            </div>
            <div class="cta cta--example half">
                <hgroup class="align-vertical">
                    <h1>CTA Title</h1>
                    <h2>Optional subtitle</h2>
                </hgroup>
            </div>
        </div>
    </section>

    <section>
        <div class="section-padding align-centre lgrey">
            <h1>HOVERBOXES</h1>

            <div class="hoverbox third-margin">
                <figure><img src="/img/placeholder.gif" alt="Hoverbox image"/></figure>
                <figcaption>
                    <h1>VISIBLE TITLE</h1>
                    <p>This portion of the caption is hidden until the image is hovered.</p>
                </figcaption>
            </div>

            <div class="hoverbox third-margin">
                <figure><img src="/img/placeholder.gif" alt="Hoverbox image"/></figure>
                <figcaption>
                    <h1>VISIBLE TITLE</h1>
                    <p>This portion of the caption is hidden until the image is hovered.</p>
                </figcaption>
            </div>

            <div class="hoverbox third-margin">
                <figure><img src="/img/placeholder.gif" alt="Hoverbox image"/></figure>
                <figcaption>
                    <h1>VISIBLE TITLE</h1>
                    <p>This portion of the caption is hidden until the image is hovered.</p>
                </figcaption>
            </div>
        </div>
    </section>

    <section>
        <div class="section-padding align-centre dgrey">
            <h1>SOCIAL BUTTONS</h1>
            <div class="social facebook">
                <a href="#">
                    <div class="icon facebook-icon"></div>
                    <div class="overlay"></div>
                </a>
            </div>
            <div class="social twitter">
                <a href="#">
                    <div class="overlay"></div>
                </a>
            </div>
            <div class="social google-plus">
                <a href="#">
                    <div class="overlay"></div>
                </a>
            </div>
            <div class="social mail">
                <a href="#">
                    <div class="overlay"></div>
                </a>
            </div>
            <div class="social linkedin">
                <a href="#">
                    <div class="overlay"></div>
                </a>
            </div>
        </div>
    </section>

</main>