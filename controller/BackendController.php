<?php
namespace Controller;

use Model\Articles;
require_once ('functions/functions.php');

class BackendController
{
    //********** admin login page access *************

    public function admin()
    {

        if ($_SESSION["user"]['role'] != 'admin') {

            //header('Location: index.php'); // if user is not admin
            //exit();


            /*header('Location:index.php?route=admin');
            exit(); */
        }

        require 'vue/backend/admin_page.php';


    }

    //********** Manage articles.php *************

    public function createArticle()
    {
        require 'vue/backend/create_article.php';//call addArticle() when form would be completed

    }

    public function addArticle() //
    {

        $addArticleErrorMessage = [];// Store error message to be available into create_article

        if (isset($_POST['btn_creer_article']))
        {
             echo $_POST['rubrique'];

            if (empty($_POST['titre']))
            {
                $addArticleErrorMessage['titre'] = "Manque le titre";
            }
            if (empty($_POST['chapo']))
            {
                $addArticleErrorMessage['chapo'] = "Manque le chapo";
            }
            if (empty($_POST['auteur']))
            {
                $addArticleErrorMessage['auteur'] = "Manque l'auteur";
            }
            if (empty($_POST['contenu']))
            {
                $addArticleErrorMessage['contenu'] = "Manque le contenu";
            }


            if(empty($addArticleErrorMessage))
            {
                $article = new Articles();

                $article->setTitre($_POST['titre']);
                $article->setChapo($_POST['chapo']);
                $article->setAuteur($_POST['auteur']);
                $article->setContenu($_POST['contenu']);
                $article->setRubrique($_POST['rubrique']);
                $article->setDateCreation(date("d-m-Y"));
                $article->setDateMiseAJour(date("d-m-Y"));

                $articleAdded = $article->setArticleToDb();
                echo 'articleAdded';
                $this->editListArticles();
                unset( $_SESSION['newArticle']); // delete data provided by user
                //require 'vue/articles.php.php';
            }
            else
            {
                echo 'btn cliqué --> formulaire non remplis totalement';
                saveFormData('newArticle');
            }
        }

        require 'vue/backend/create_article.php';

    }

    public function editListArticles()
    {
        $articles = new Articles();
        $articlesEdited = $articles->getListArticles();
        require 'vue/backend/list_articles.php';

    }

    public function editArticlePage()
    {
         require 'vue/backend/edit_article.php';
    }

    public function editArticle($idArticle)
    {
        $getArticle = new Articles();
        $article = $getArticle->getSingleArticle($idArticle);
        require 'vue/backend/show_article.php';

    }

    public function deleteArticle($idArticle)
    {
        $articles = new Articles();
        $articleDeleted = $articles->deleteArticle($idArticle);
        if ($articleDeleted) {
            header('Location:index.php?route=editListArticles');

            exit();
        }

    }


}


