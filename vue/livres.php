<?php ob_start(); ?>

<!-- Blog Author -->
<header class="masthead" style="background-image: url('public/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Blog de Damir M</h1>
                    <span class="subheading">Liste des articles de livres</span>
                </div>
            </div>
        </div>
    </div>
</header>

<?php foreach ($articles as $article) : ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-preview">
                    <a href="index.php?route=article&id=<?= $article->getArticles_id() ?>">

                        <h2 class="post-title">
                            <?= htmlspecialchars($article->getTitre()); ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?= htmlspecialchars($article->getChapo()); ?>
                        </h3>
                    </a>

                    <p class="post-meta">Modifié le :
                        <?= htmlspecialchars($article->getDate_mise_a_jour()); ?>
                    </p>

                </div>
                <hr>
                <a href="index.php?route=article&id=<?= htmlspecialchars($article->getArticles_id()) ?>">Voir
                    l'article</a>

            </div>
        </div>
    </div>
<?php endforeach ?>
<?php $content = ob_get_clean(); ?>
<?php require 'templates/layout_gabarit.php'; ?>
