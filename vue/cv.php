<?php ob_start(); ?>

<!-- Blog Author -->
<header class="masthead" style="background-image: url('public/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Blog de Damir M</h1>
                    <span class="subheading">CV</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <!-- CV. -->
            <object data="public/pdf/cv.pdf" type="application/pdf" width="600" height="800">
                Lien vers mon cv : <a href="public/pdf/cv.pdf">test.pdf</a>
            </object>

        </div>
    </div>
</div>
<hr>
<?php $content = ob_get_clean(); ?>
<?php require 'templates/layout_gabarit.php'; ?>
