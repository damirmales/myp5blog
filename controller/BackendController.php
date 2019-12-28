<?php

namespace Controller;
use Model\ArticleDao;
use Model\Articles;
use Model\CommentDao;

require_once 'functions/functions.php';
require_once 'functions/securizeFormFields.php';

class BackendController
{
    //********** admin login page access *************

    public function admin()
    {
        //!!!!!!!!!!!!!!! verifier l existence de la session !!!!!!!!!!!!!!
        if ($_SESSION["user"]['role'] != 'admin') {

            header('Location: index.php'); // if user is not admin
            exit();
        }
        include 'vue/backend/admin_page.php';
    }
    //*****************************************************************
    //******************** Manage articles ************************
    //*****************************************************************

    public function createArticle()
    {
        include 'vue/backend/create_article.php';//call addArticle() when form will be completed
    }

    public function addArticle() //
    {
        $addArticleErrorMessage = [];// Store error message to be available into create_article
        $post = securizeFormFields($_POST);

        if (isset($post['btn_creer_article'])) {
            if (empty($post['titre'])) {
                $addArticleErrorMessage['titre'] = setFlash("Attention !", "Manque le titre", 'warning');
            } elseif (strlen($post['titre']) < 3) {
                $addArticleErrorMessage['titre'] = setFlash("Attention !", 'Votre titre doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['titre']) > 45) {
                $addArticleErrorMessage['titre'] = setFlash("Attention !", 'Votre titre doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['chapo'])) {
                $addArticleErrorMessage['chapo'] = setFlash("Attention !", "Manque le chapo", 'warning');
            } elseif (strlen($post['chapo']) < 3) {
                $addArticleErrorMessage['chapo'] = setFlash("Attention !", 'Votre chapo doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['chapo']) > 45) {
                $addArticleErrorMessage['chapo'] = setFlash("Attention !", 'Votre auteur doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['auteur'])) {
                $addArticleErrorMessage['auteur'] = setFlash("Attention !", "Manque l'auteur", 'warning');
            } elseif (strlen($post['auteur']) < 3) {
                $addArticleErrorMessage['auteur'] = setFlash("Attention !", 'Votre auteur doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['auteur']) > 45) {
                $addArticleErrorMessage['auteur'] = setFlash("Attention !", 'Votre auteur doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['contenu'])) {
                $addArticleErrorMessage['contenu'] = setFlash("Attention !", "Manque le contenu", 'warning');
            }

            if (empty($addArticleErrorMessage)) {
                $article = new Articles($post);
                $articleDao = new ArticleDao(); //////////// voir gestion instance en Singleton
                $articleAdded = $articleDao->setArticleToDb($article);

                $messOk = setFlash("Super !", "Article ajouté", 'success');

                $this->showArticle($articleAdded);
                unset($_SESSION['newArticle']); // delete data provided by user
                //require 'vue/articles.php.php';
            }
        }
        saveFormData('newArticle');
        include 'vue/backend/create_article.php';
    }

    /**********************
     *
     * display article
     ****************************/
    public function showArticle($idArticle)
    {
        $getArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $getArticle->getSingleArticle($idArticle);
        include 'vue/backend/show_article.php';
    }

    public function updateArticle2()
    {
        $updateArticleErrorMessage = [];
        $post = securizeFormFields($_POST);
        if (isset($post['btn_update_article'])) {

            if (empty($post['titre'])) {
                $updateArticleErrorMessage['titre'] = setFlash("Attention !", "Manque le titre", 'warning');

            } elseif (strlen($post['titre']) < 3) {
                $updateArticleErrorMessage['titre'] = setFlash("Attention !", 'Votre titre doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['titre']) > 45) {
                $updateArticleErrorMessage['titre'] = setFlash("Attention !", 'Votre titre doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['chapo'])) {
                $updateArticleErrorMessage['chapo'] = setFlash("Attention !", "Manque le chapo", 'warning');
            } elseif (strlen($post['chapo']) < 3) {
                $updateArticleErrorMessage['chapo'] = setFlash("Attention !", 'Votre chapo doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['chapo']) > 45) {
                $updateArticleErrorMessage['chapo'] = setFlash("Attention !", 'Votre auteur doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['auteur'])) {
                $updateArticleErrorMessage['auteur'] = setFlash("Attention !", "Manque l'auteur", 'warning');
            } elseif (strlen($post['auteur']) < 3) {
                $updateArticleErrorMessage['auteur'] = setFlash("Attention !", 'Votre auteur doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['auteur']) > 45) {
                $updateArticleErrorMessage['auteur'] = setFlash("Attention !", 'Votre auteur doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['contenu'])) {
                $updateArticleErrorMessage['contenu'] = setFlash("Attention !", "Manque le contenu", 'warning');
            }

            if (empty($updateArticleErrorMessage)) {
                $article = new Articles($post);
                $articleDao = new ArticleDao(); //////////// voir gestion instance en Singleton
                $articleUpdate = $articleDao->updateArticleToDb($article);
                if ($articleUpdate) {
                    $this->showArticle($post['articles_id']);
                }
            }
            //saveFormData('newArticle');
            include 'vue/backend/edit_article.php';
        }
    }

    public function updateArticle()
    {
        $updateArticleErrorMessage = [];
        $post = securizeFormFields($_POST);

        if (isset($post['btn_update_article'])) {
            if (empty($post['titre'])) {
                $updateArticleErrorMessage['titre'] = setFlash("Attention !", "Manque le titre", 'warning');
            } elseif (strlen($post['titre']) < 3) {
                $updateArticleErrorMessage['titre'] = setFlash("Attention !", 'Votre titre doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['titre']) > 45) {
                $updateArticleErrorMessage['titre'] = setFlash("Attention !", 'Votre titre doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['chapo'])) {
                $updateArticleErrorMessage['chapo'] = setFlash("Attention !", "Manque le chapo", 'warning');
            } elseif (strlen($post['chapo']) < 3) {
                $updateArticleErrorMessage['chapo'] = setFlash("Attention !", 'Votre chapo doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['chapo']) > 45) {
                $updateArticleErrorMessage['chapo'] = setFlash("Attention !", 'Votre auteur doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['auteur'])) {
                $updateArticleErrorMessage['auteur'] = setFlash("Attention !", "Manque l'auteur", 'warning');
            } elseif (strlen($post['auteur']) < 3) {
                $updateArticleErrorMessage['auteur'] = setFlash("Attention !", 'Votre auteur doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['auteur']) > 45) {
                $updateArticleErrorMessage['auteur'] = setFlash("Attention !", 'Votre auteur doit faire moins de 45 caractères', 'warning');
            }
            if (empty($post['contenu'])) {
                $updateArticleErrorMessage['contenu'] = setFlash("Attention !", "Manque le contenu", 'warning');
            }
            $article = new Articles($post);
            if (empty($updateArticleErrorMessage)) {
                $articleDao = new ArticleDao(); //////////// voir gestion instance en Singleton
                $articleUpdate = $articleDao->updateArticleToDb($article);
                if ($articleUpdate) {
                    $_SESSION['updateArticle'] = setFlash("Super !", "Article mis à jour", 'success');
                    $this->showArticle($post['articles_id']);
                }
            } else {
                include 'vue/backend/edit_article.php';
            }
        }
    }

    public function editListArticles()
    {
        $articles = new ArticleDao(); //////////// voir gestion instance en Singleton
        $articlesEdited = $articles->getListArticles();
        include 'vue/backend/list_articles.php';
    }

    /**********************
     *
     * display current article's datas to be modified
     ****************************/
    public function editArticle($idArticle)
    {
        $getArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $getArticle->getSingleArticle($idArticle);
        include_once 'vue/backend/edit_article.php';
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

    public function showComment($idArticle)
    {
        $getArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $getArticle->getSingleArticle($idArticle);
        include 'vue/backend/show_article.php';
    }

    public function deleteComment($idComment)
    {
        $comment = new CommentDao(); //////////// voir gestion instance en Singleton
        $commentDeleted = $comment->deleteComment($idComment);

        if ($commentDeleted) {
            $this->editListComments();
        }
    }

    public function editListComments()
    {
        $comments = new CommentDao(); //////////// voir gestion instance en Singleton
        $commentEdited = $comments->getListComments();
        include 'vue/backend/list_comments.php';
    }

    public function validateComment($idComment)
    {
        $getComment = new CommentDao(); //////////// voir gestion instance en Singleton
        $comment = $getComment->validateComment($idComment);
        $this->editListComments();
    }
}


