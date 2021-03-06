<?php

namespace Controller;

use Model\ArticleDao;
use Model\Articles;
use Model\CommentDao;
use Services\CheckArticleInputs;
use Services\FormData;
use Services\FormGlobals;
use Services\Messages;
use Services\Session;


class BackendController
{

    /**
     * /* admin login page access
     */
    public function admin()
    {
        $mySession = new Session();
        if ($mySession->get('user', 'role') != 'admin') {// from frontendController checkUser() method via Router
            header('Location: index.php');
        }
        include 'vue/backend/adminPage.php';
    }

    /**
     * Manage articles
     */
    public function createArticle()
    {
        include 'vue/backend/createArticle.php';//call addArticle() when form will be completed
    }

    /**
     *
     */
    public function addArticle()
    {
        $input = new FormGlobals();
        $checkInput = new CheckArticleInputs();
        $addArticleErrorMessage = $checkInput->checkArticleInputs($input->post());

        $post = FormData::securizeFormFields($input->post());
        FormData::saveFormData('newArticle', $post);

        if (empty($addArticleErrorMessage)) {
            $article = new Articles($post);
            $articleDao = new ArticleDao();
            $articleAdded = $articleDao->setArticleToDb($article);
            //$_SESSION['newArticle'] = Messages::setFlash("Super !", "Article ajouté", 'success');
            $session = new Session();
            $session->set('new', 'article', Messages::setFlash("Super !", "Article ajouté", 'success'));

            header('Location: index.php?route=showArticle&id=' . $articleAdded);
        }
        include 'vue/backend/createArticle.php';
    }

    /**
     *
     */
    public function updateArticle()
    {
        $input = new FormGlobals();
        $checkInput = new  CheckArticleInputs();
        $updateArticleErrorMessage = $checkInput->checkArticleInputs($input->post());
        $post = FormData::securizeFormFields($input->post());

        $article = new Articles($post);
        if (empty($updateArticleErrorMessage)) {
            $articleDao = new ArticleDao();
            $articleUpdate = $articleDao->updateArticleToDb($article);
            if ($articleUpdate) {
                //$_SESSION['updateArticle'] = Messages::setFlash("Super !", "Article mis à jour", 'success');
                $session = new Session();
                $session->set('update', 'article', Messages::setFlash("Super !", "Article mis à jour", 'success'));

                $this->showArticle($post['articles_id']);
            }
        } else {
            include 'vue/backend/editArticle.php';
        }

    }

    /**
     * display article
     **/
    public function showArticle($idArticle)
    {
        $getArticle = new ArticleDao();
        $article = $getArticle->getSingleArticle($idArticle);
        include 'vue/backend/showArticle.php';
    }

    /**
     *
     */
    public function editListArticles()
    {
        $articles = new ArticleDao();
        $articlesEdited = $articles->getArticlesByCategory('all');
        include 'vue/backend/listArticles.php';
    }

    /**
     * display current article's datas to be modified
     **/
    public function editArticle($idArticle)
    {
        $getArticle = new ArticleDao();
        $article = $getArticle->getSingleArticle($idArticle);
        include_once 'vue/backend/editArticle.php';
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
        }
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
        include 'vue/backend/listComments.php';
    }

    public function validateComment($idComment)
    {
        $getComment = new CommentDao(); //////////// voir gestion instance en Singleton
        $comment = $getComment->validateComment($idComment);
        $this->editListComments();
    }
}


