<?php

use Controller\FrontendController;
use Controller\BackendController;
use Services\FormGlobals;

class Router
{
    protected $get;

    /**
     *
     */
    public function run()
    {
        $frontController = new FrontendController;
        $backController = new BackendController;

        $input = new FormGlobals();
        try {
            if ($input->get('route')) {
                $get = filter_var(stripslashes($input->get('route')), FILTER_SANITIZE_SPECIAL_CHARS);
                if ($get === 'contactForm') {
                    $frontController->addContact($input->post());
                } elseif ($get === 'cv') {
                    $frontController->cv();
                } elseif ($get === 'home') {
                    $frontController->home();
                } elseif ($get === 'contact') {
                    $frontController->contact();
                } elseif ($get === 'liste') {
                    $frontController->pullListeArticles();
                } elseif ($get === 'article') {
                    $frontController->getArticle($input->get('id'));
                } elseif ($get === 'admin') {
                    // from frontendController checkUser() method
                    $backController = new BackendController;
                    $backController->admin();
                } elseif ($get === 'addComment') {
                    $frontController->addComment($input->get('id'), $input->post());
                } elseif ($get == 'livres') {
                    $frontController->getCategoryArticles($get);
                } elseif ($get == 'fromages') {
                    $frontController->getCategoryArticles($get);
                    // go to login.php form page
                } elseif ($get === 'connexion') {
                    $frontController->logUser();
                    // go to logAdmin.php form page
                } elseif ($get === 'connexionAdmin') {
                    $frontController->logAdmin();
                } elseif ($get === 'deconnexion') {
                    $frontController->logOff();
                    // from login.php check admin data to login
                } elseif ($get === 'pageUser') {
                    $frontController->checkUser();
                    // from login.php check admin data to login
                } elseif ($get === 'pageAdmin') {
                    $frontController->checkUser();
                    // to the register form page
                } elseif ($get === 'register') {
                    $frontController->register();
                    // register user's data into the database
                } elseif ($get === 'addUser') {
                    $frontController->addUser();
                    // check user email via token
                } elseif ($get === 'verifEmail') {
                    $frontController->verifyToken();
                } elseif ($get === 'errorMessage') {
                    $frontController->errorsException($input->get('exception'));
                } /**
                 * PARTIE BACKEND
                 */
                elseif ($get === 'createArticle') {
                    $backController->createArticle();
                } elseif ($get === 'addArticle') {
                    $backController->addArticle();
                } elseif ($get === 'editArticle') {
                    $backController->editArticle($input->get('id'));
                } elseif ($get === 'updateArticle') {
                    $backController->updateArticle();
                } elseif ($get === 'editListArticles') {
                    $backController->editListArticles();
                } elseif ($get === 'deleteArticle') {
                    $backController->deleteArticle($input->get('id'));
                } elseif ($get === 'showArticle') {
                    $backController->showArticle($input->get('id'));
                } /**
                 * manage comments
                 */
                elseif ($get === 'listComments') {
                    $backController->editListComments();
                } elseif ($get === 'deleteComment') {
                    $backController->deleteComment($input->get('id'));
                } elseif ($get === 'validateComment') {
                    $backController->validateComment($input->get('id'));
                } else header('Location:/404.php');
            } else $frontController->home();
        } catch (Exception $e) {
            $errorException = ('Erreur niveau Router  : ' . $e->getMessage());
            header('Location: index.php?route=errorMessage&exception=' . $errorException);

        }
    }
}
    