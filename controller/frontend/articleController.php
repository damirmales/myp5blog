
<?php
//use Model/Articles;

require('../model/Articles.php');


if (isset($_GET['id']) && $_GET['id'] > 0) {
    $article = getSingleArticle($_GET['id']);
    //$comments = getComments($_GET['id']);
    require('../../vue/article.php');
}
else {
    echo 'Erreur : aucun identifiant de billet envoyé';
}

