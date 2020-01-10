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

    /**
     *
     */
    public function addArticle()
    {
        $input = new FormGlobals();
        $checkInput = new  CheckArticleInputs();
        $addArticleErrorMessage = $checkInput->checkArticleInputs($input->post());


        echo '<pre> 2checkArticleInputs ';
        var_dump($addArticleErrorMessage);

        $post = FormData::securizeFormFields($input->post());
        FormData::saveFormData('newArticle', $post);

        if (empty($addArticleErrorMessage)) {

            $article = new Articles($post);
            $articleDao = new ArticleDao(); //////////// voir gestion instance en Singleton
            $articleAdded = $articleDao->setArticleToDb($article);
            //$_SESSION['newArticle'] = Messages::setFlash("Super !", "Article ajouté", 'success');
            header('Location: index.php?route=showArticle&id=' . $articleAdded);
            exit();
        }

        include 'vue/backend/create_article.php';
    }

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
                $_SESSION['updateArticle'] = Messages::setFlash("Super !", "Article mis à jour", 'success');
                $this->showArticle($post['articles_id']);
            }
        } else {
            include 'vue/backend/edit_article.php';
        }

    }

    /**
     * display article
     **/
    public
    function showArticle($idArticle)
    {
        $getArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $getArticle->getSingleArticle($idArticle);
        include 'vue/backend/show_article.php';
    }

    public
    function editListArticles()
    {
        $articles = new ArticleDao();
        $articlesEdited = $articles->getListArticles();
        include 'vue/backend/list_articles.php';
    }

    /**
     * display current article's datas to be modified
     **/
    public
    function editArticle($idArticle)
    {
        $getArticle = new ArticleDao();
        $article = $getArticle->getSingleArticle($idArticle);
        include_once 'vue/backend/edit_article.php';
    }

    /**
     * @param $idArticle
     */
    public
    function deleteArticle($idArticle)
    {
        $articles = new ArticleDao();
        $articleDeleted = $articles->deleteArticle($idArticle);
        if ($articleDeleted) {
            header('Location:index.php?route=editListArticles');
            exit();
        }
    }

    public
    function showComment($idArticle)
    {
        $getArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $getArticle->getSingleArticle($idArticle);
        include 'vue/backend/show_article.php';
    }

    public
    function deleteComment($idComment)
    {
        $comment = new CommentDao();
        $commentDeleted = $comment->deleteComment($idComment);
        if ($commentDeleted) {
            $this->editListComments();
        }
    }

    public
    function editListComments()
    {
        $comments = new CommentDao();
        $commentEdited = $comments->getListComments();
        include 'vue/backend/list_comments.php';
    }

    public
    function validateComment($idComment)
    {
        $getComment = new CommentDao(); //////////// voir gestion instance en Singleton
        $comment = $getComment->validateComment($idComment);
        $this->editListComments();
    }
}


