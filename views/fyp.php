<header id="fixed-header" class="fixed-header--fyp section-padding">
    <hgroup class="align-vertical">
        <h1>FINAL YEAR PROJECT</h1>
        <?php require_once('includes/balls.php'); ?>
    </hgroup>
</header>

<main>

    <section>
        <div class="section-padding align-centre lgrey">
            <h1><i class="ico-cell-logo"></i>THE PROJECT</h1>
            <p class="full">Cell Industries is a Multimedia Technology and Design University of Kent Final Year Project by <a href="http://precisepixels.co.uk" target="_blank">Precise Pixels</a>:</p>
            <p class="full"><a href="http://jacobhammond.co.uk/" target="_blank">Jacob Hammond</a><br>
            <a href="http://jalproductions.co.uk/" target="_blank">James Lee</a><br>
            <a href="http://faooful.com/" target="_blank">Joseph Williams</a></p>
            <p class="full">For more information, see the <a href="http://precisepixels.co.uk/blog/" target="_blank">Progress Blog</a>.</p>
        </div>
    </section>

    <section>
        <div class="section-padding align-centre mblue">
            <h1><i class="ico-speech"></i>USER FEEDBACK</h1>
            <p class="full">As part of the project, it is important that we gather real user feedback.</p>
            <p class="full">Please <a href="https://docs.google.com/forms/d/1BxVO4AInJ2K8zNFQ2DxVs-wp76895AKe4DNR4R2ECkc/viewform" target="_blank">fill out this quick survey</a>. It should only take around 5 minutes.</p>
        </div>
    </section>

    <section>
        <div class="section-padding align-centre lgrey">
            <h1><i class="ico-cell-logo"></i>GITHUB INFO</h1>
            <p>URL: <a href="https://github.com/Precise-Pixels/cell" target="_blank">https://github.com/Precise-Pixels/cell</a></p>
            <p>Language Distribution: PHP 49.5% | Javascript 29.5% | CSS 21.0%</p>
            <p>Commits: <?= $commits; ?></p>
            <p>Branches: <?= $branches; ?></p>
            <p>Pull Requests: <?= $pulls; ?></p>
        </div>
    </section>

</main>