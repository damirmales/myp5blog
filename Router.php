<?php

use Controller\FrontendController;
use Controller\BackendController;
use Services\FormGlobals;

class Router
{
    protected $get;

    public function run()
    {
        $input = new FormGlobals();
        try {
            if ($input->get('route')) {
                $get = filter_var(stripslashes($input->get('route')), FILTER_SANITIZE_SPECIAL_CHARS);
                if ($get === 'contactForm') {
                    $frontController = new FrontendController;
                    $frontController->addContact($input->post());
                } elseif ($get === 'cv') {
                    $frontController = new FrontendController;
                    $frontController->cv();
                } elseif ($get === 'contact') {
                    $frontController = new FrontendController;
                    $frontController->contact();
                } elseif ($get === 'liste') {
                    $frontController = new FrontendController;
                    $frontController->pullListeArticles();
                } elseif ($get === 'article') {
                    $frontController = new FrontendController;
                    $frontController->getArticle($input->get('id'));
                } elseif ($get === 'admin') {
                    // from frontendController checkUser() method
                    $backController = new BackendController;
                    $backController->admin();
                } elseif ($get === 'addComment') {
                    $frontController = new FrontendController;
                    $frontController->addComment($input->get('id'), $input->post());
                } elseif ($get == 'livres') {
                    $frontController = new FrontendController;
                    $frontController->getCategoryArticles($get);
                } elseif ($get == 'fromages') {
                    $frontController = new FrontendController;
                    $frontController->getCategoryArticles($get);
                    // go to login.php form page
                } elseif ($get === 'connexion') {
                    $frontController = new FrontendController;
                    $frontController->logUser();
                    // go to logAdmin.php form page
                } elseif ($get === 'connexionAdmin') {
                    $frontController = new FrontendController;
                    $frontController->logAdmin();
                } elseif ($get === 'deconnexion') {
                    $frontController = new FrontendController;
                    $frontController->logOff();
                    // from login.php check admin data to login
                } elseif ($get === 'pageUser') {
                    $frontController = new FrontendController;
                    $frontController->checkUser();
                    // from login.php check admin data to login
                } elseif ($get === 'pageAdmin') {
                    $frontController = new FrontendController;
                    $frontController->checkUser();
                    // to the register form page
                } elseif ($get === 'register') {
                    $frontController = new FrontendController;
                    $frontController->register();
                    // register user's data into the database
                } elseif ($get === 'addUser') {
                    $frontController = new FrontendController;
                    $frontController->addUser();
                    // check user email via token
                } elseif ($get === 'verifEmail') {
                    $frontController = new FrontendController;
                    $frontController->verifyToken();
                } /**
                 * PARTIE BACKEND
                 */
                elseif ($get === 'createArticle') {
                    $backController = new BackendController;
                    $backController->createArticle();
                } elseif ($get === 'addArticle') {
                    $backController = new BackendController;
                    $backController->addArticle();
                } elseif ($get === 'editArticle') {
                    $backController = new BackendController;
                    $backController->editArticle($input->get('id'));
                } elseif ($get === 'updateArticle') {
                    $backController = new BackendController;
                    $backController->updateArticle();
                } elseif ($get === 'editListArticles') {
                    $backController = new BackendController;
                    $backController->editListArticles();
                } elseif ($get === 'deleteArticle') {
                    $backController = new BackendController;
                    $backController->deleteArticle($input->get('id'));
                } elseif ($get === 'showArticle') {
                    $backController = new BackendController;
                    $backController->showArticle($input->get('id'));
                } /**
                 * manage comments
                 */
                elseif ($get === 'listComments') {
                    $backController = new BackendController;
                    $backController->editListComments();

                } elseif ($get === 'deleteComment') {
                    $backController = new BackendController;
                    $backController->deleteComment($input->get('id'));

                } elseif ($get === 'validateComment') {
                    $backController = new BackendController;
                    $backController->validateComment($input->get('id'));
                } else {
                    echo 'page inconnue ' . $get;
                }
            } else {
                $frontController = new FrontendController;
                $frontController->home();
            }
        } catch (Exception $e) {
            echo 'Erreur niveau Router :' . $e->getMessage();
        }
    }
}
    