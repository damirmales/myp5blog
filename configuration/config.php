<?php
//************ initialisation  ************
$_SESSION["registerFormOK"] = null;
$_SESSION["registerFormKO"] = null;
if (!isset($_SESSION['user']['role']))
{
    $_SESSION['user']['role'] = null ;
}
/********************** Utile pour le formulaire de contact de la home.php ******************/
$_SESSION['input']['nom'] = null ;
$_SESSION['input']['prenom'] = null ;
$_SESSION['input']['email'] = null ;
$_SESSION['input']['message'] = null ;

/********************** Utile pour le formulaire d'enregistrement de register.php ******************/
$_SESSION['register']['nom'] = null ;
$_SESSION['register']['prenom'] = null ;
$_SESSION['register']['email'] = null ;
$_SESSION['register']['login'] = null ;
$_SESSION['register']['password'] = null ;
$_SESSION['register']['password2'] = null ;

/********************** Utile pour le formulaire de creation d'articles de create_article.php ******************/
$_SESSION['newArticle']['titre']= null ;
$_SESSION['newArticle']['auteur']= null ;
$_SESSION['newArticle']['chapo']= null ;
$_SESSION['newArticle']['contenu']= null ;

/********************** Utile pour le formulaire de creation de commentaire de commentForm.php ******************/
$_SESSION['user']['nom']= "" ;
$_SESSION['user']['email']= "" ;
$_SESSION['user']['comment']= "" ;

