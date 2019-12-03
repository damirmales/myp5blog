<?php
namespace Controller;

use Model\ArticleDao;
use Model\Articles;

require_once('functions/functions.php');

class BackendController
{
    //********** admin login page access *************

    public function admin()
    {
//!!!!!!!!!!!!!!! verifier l existence de la session !!!!!!!!!!!!!!

        if ($_SESSION["user"]['role'] != 'admin') {

            header('Location: index.php'); // if user is not admin
            exit();


            /*header('Location:index.php?route=admin');
            exit(); */
        }

        require 'vue/backend/admin_page.php';


    }
    //*****************************************************************
    //******************** Manage articles ************************
    //*****************************************************************

    public function createArticle()
    {
        require 'vue/backend/create_article.php';//call addArticle() when form would be completed
    }

    public function addArticle() //
    {
        $addArticleErrorMessage = [];// Store error message to be available into create_article

        if (isset($_POST['btn_creer_article'])) {
            echo $_POST['rubrique'];

            if (empty($_POST['titre'])) {
                $addArticleErrorMessage['titre'] = "Manque le titre";
            }
            if (empty($_POST['chapo'])) {
                $addArticleErrorMessage['chapo'] = "Manque le chapo";
            }
            if (empty($_POST['auteur'])) {
                $addArticleErrorMessage['auteur'] = "Manque l'auteur";
            }
            if (empty($_POST['contenu'])) {
                $addArticleErrorMessage['contenu'] = "Manque le contenu";
            }


            if (empty($addArticleErrorMessage)) {
                $article = new Articles($_POST);

                $articleDao = new ArticleDao(); //////////// voir gestion instance en Singleton
                $articleAdded = $articleDao->setArticleToDb($article);
                echo 'articleAdded';
                $this->editListArticles();
                unset($_SESSION['newArticle']); // delete data provided by user
                //require 'vue/articles.php.php';
            } else {
                echo 'btn cliqué --> formulaire non remplis totalement';
                saveFormData('newArticle');
            }
        }

        require 'vue/backend/create_article.php';
    }

    public function updateArticle()
    {
        /*print_r($_POST);
        print_r($article);
        die();*/
        $article = new Articles($_POST);
        $articleDao = new ArticleDao(); //////////// voir gestion instance en Singleton
        $articleUpdate = $articleDao->updateArticleToDb($article);
        if ($articleUpdate) {

            echo 'btn cliqué --> formulaire non remplis totalement';
            //header('Location:index.php?route=editListArticles');
            //exit();
            $this->showArticle($idArticle);

        }
    }


    public function editListArticles()
    {
        $articles = new ArticleDao(); //////////// voir gestion instance en Singleton
        $articlesEdited = $articles->getListArticles();
        require 'vue/backend/list_articles.php';

    }

    public function editArticle($idArticle)
    {
        $getArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $getArticle->getSingleArticle($idArticle);
        /*echo '<pre> editarticle'; var_dump($article);
        die ();*/
        require 'vue/backend/edit_article.php';

    }

    public function showArticle($idArticle)
    {
        $getArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $getArticle->getSingleArticle($idArticle);

        require 'vue/backend/show_article.php';

    }


    public function deleteArticle($idArticle)
    {
        $articles = new ArticleDao(); //////////// voir gestion instance en Singleton
        $articleDeleted = $articles->deleteArticle($idArticle);
        if ($articleDeleted) {
            header('Location:index.php?route=editListArticles');

            exit();
        }
    }

    //*****************************************************************
    //******************** Manage comments  ************************
    //*****************************************************************

    public function editLisComments()
    {
        $articles = new ArticleDao(); //////////// voir gestion instance en Singleton
        $articlesEdited = $articles->getListArticles();
        require 'vue/backend/list_articles.php';
    }

    public function showComment($idArticle)
    {
        $getArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $getArticle->getSingleArticle($idArticle);
        require 'vue/backend/show_article.php';
    }

    public function deleteComment($idArticle)
    {
        $articles = new ArticleDao(); //////////// voir gestion instance en Singleton
        $articleDeleted = $articles->deleteArticle($idArticle);
        if ($articleDeleted) {
            header('Location:index.php?route=editListArticles');
            exit();
        }
    }
}


