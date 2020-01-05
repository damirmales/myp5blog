<?php

namespace Controller;

use Model\ArticleDao;
use Model\Articles;
use Model\CommentDao;
use Services\FormData;
use Services\Messages;
use Services\Session;

class BackendController
{
    /**
    /* admin login page access
    */
    public function admin()
    {

        $session = &$_SESSION;
           if ($session["user"]['role'] != 'admin') {// from frontendController checkUser() method via Router

            header('Location: index.php'); // if user is NOT admin
            exit();
        }
        include 'vue/backend/admin_page.php';
    }

    /**
     * Manage articles
     */
    public function createArticle()
    {
        include 'vue/backend/create_article.php';//call addArticle() when form will be completed
    }

    public function addArticle() //
    {
        $addArticleErrorMessage = [];// Store error message to be available into create_article
        $post = FormData::securizeFormFields($_POST);

        if (isset($post['btn_creer_article'])) {
            if (empty($post['titre'])) {
                $addArticleErrorMessage['titre'] = Messages::setFlash("Attention !", "Manque le titre", 'warning');
            } elseif (strlen($post['titre']) < 3) {
                $addArticleErrorMessage['titre'] = Messages::setFlash("Attention !", 'Votre titre doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['titre']) > 45) {
                $addArticleErrorMessage['titre'] = Messages::setFlash("Attention !", 'Votre titre doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['chapo'])) {
                $addArticleErrorMessage['chapo'] = Messages::setFlash("Attention !", "Manque le chapo", 'warning');
            } elseif (strlen($post['chapo']) < 3) {
                $addArticleErrorMessage['chapo'] = Messages::setFlash("Attention !", 'Votre chapo doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['chapo']) > 45) {
                $addArticleErrorMessage['chapo'] = Messages::setFlash("Attention !", 'Votre auteur doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['auteur'])) {
                $addArticleErrorMessage['auteur'] = Messages::setFlash("Attention !", "Manque l'auteur", 'warning');
            } elseif (strlen($post['auteur']) < 3) {
                $addArticleErrorMessage['auteur'] = Messages::setFlash("Attention !", 'Votre auteur doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['auteur']) > 45) {
                $addArticleErrorMessage['auteur'] = Messages::setFlash("Attention !", 'Votre auteur doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['contenu'])) {
                $addArticleErrorMessage['contenu'] = Messages::setFlash("Attention !", "Manque le contenu", 'warning');
            }
            FormData::saveFormData('newArticle', $post);

            if (empty($addArticleErrorMessage)) {
                $article = new Articles($post);
                $articleDao = new ArticleDao(); //////////// voir gestion instance en Singleton
                $articleAdded = $articleDao->setArticleToDb($article);
                //$_SESSION['newArticle'] = Messages::setFlash("Super !", "Article ajouté", 'success');
                header('Location: index.php?route=showArticle&id=' . $articleAdded);
                exit();
                //$this->showArticle($articleAdded);
                // unset($_SESSION['newArticle']);
            }
        }
        include 'vue/backend/create_article.php';
    }

    public function updateArticle()
    {
        $updateArticleErrorMessage = [];
        $post = FormData::securizeFormFields($_POST);

        if (isset($post['btn_update_article'])) {
            if (empty($post['titre'])) {
                $updateArticleErrorMessage['titre'] = Messages::setFlash("Attention !", "Manque le titre", 'warning');
            } elseif (strlen($post['titre']) < 3) {
                $updateArticleErrorMessage['titre'] = Messages::setFlash("Attention !", 'Votre titre doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['titre']) > 45) {
                $updateArticleErrorMessage['titre'] = Messages::setFlash("Attention !", 'Votre titre doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['chapo'])) {
                $updateArticleErrorMessage['chapo'] = Messages::setFlash("Attention !", "Manque le chapo", 'warning');
            } elseif (strlen($post['chapo']) < 3) {
                $updateArticleErrorMessage['chapo'] = Messages::setFlash("Attention !", 'Votre chapo doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['chapo']) > 45) {
                $updateArticleErrorMessage['chapo'] = Messages::setFlash("Attention !", 'Votre auteur doit faire moins de 45 caractères', 'warning');
            }

            if (empty($post['auteur'])) {
                $updateArticleErrorMessage['auteur'] = Messages::setFlash("Attention !", "Manque l'auteur", 'warning');
            } elseif (strlen($post['auteur']) < 3) {
                $updateArticleErrorMessage['auteur'] = Messages::setFlash("Attention !", 'Votre auteur doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($post['auteur']) > 45) {
                $updateArticleErrorMessage['auteur'] = Messages::setFlash("Attention !", 'Votre auteur doit faire moins de 45 caractères', 'warning');
            }
            if (empty($post['contenu'])) {
                $updateArticleErrorMessage['contenu'] = Messages::setFlash("Attention !", "Manque le contenu", 'warning');
            }
            $article = new Articles($post);
            if (empty($updateArticleErrorMessage)) {
                $articleDao = new ArticleDao();
                $articleUpdate = $articleDao->updateArticleToDb($article);
                if ($articleUpdate) {
                    $_SESSION['updateArticle'] = Messages::setFlash("Super !", "Article mis à jour", 'success');
                    $this->showArticle($post['articles_id']);
                }
            } else {
                include 'vue/backend/edit_article.php';
            }
        }
    }

    /**
     * display article
     **/
    public function showArticle($idArticle)
    {
        $getArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $getArticle->getSingleArticle($idArticle);
        include 'vue/backend/show_article.php';
    }

    public function editListArticles()
    {
        $articles = new ArticleDao();
        $articlesEdited = $articles->getListArticles();
        include 'vue/backend/list_articles.php';
    }

    /**
     * display current article's datas to be modified
     **/
    public function editArticle($idArticle)
    {
        $getArticle = new ArticleDao();
        $article = $getArticle->getSingleArticle($idArticle);
        include_once 'vue/backend/edit_article.php';
    }

    /**
     * @param $idArticle
     */
    public function deleteArticle($idArticle)
    {
        $articles = new ArticleDao();
        $articleDeleted = $articles->deleteArticle($idArticle);
        if ($articleDeleted) {
            header('Location:index.php?route=editListArticles');
            exit();
        }
    }

    public function showComment($idArticle)
    {
        $getArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $getArticle->getSingleArticle($idArticle);
        include 'vue/backend/show_article.php';
    }

    public function deleteComment($idComment)
    {
        $comment = new CommentDao();
        $commentDeleted = $comment->deleteComment($idComment);

        if ($commentDeleted) {
            $this->editListComments();
        }
    }

    public function editListComments()
    {
        $comments = new CommentDao();
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


