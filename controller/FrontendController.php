<?php

namespace Controller;

use Model\CommentDao;
use Model\ArticleDao;
use Model\Comments;
use Model\Users;
use Model\UserDao;
use Services\CheckContactInputs;
use Services\CheckUserInputs;
use Services\Emails;
use Services\FormData;
use Services\FormGlobals;
use Services\ImportPage;
use Services\Messages;
use Services\Session;

class FrontendController
{

    /**
     * home management
     **/
    public function home()
    {
        include 'vue/home.php';
    }

    /**
     * cv
     */
    public function cv()
    {
        include 'vue/cv.php';
    }

    /**
     * contact from top menu
     **/
    public function contact()
    {
        include 'vue/home.php';
    }

    /**
     * Front articles.php management
     **/
    public function pullListeArticles() // get all articles
    {
        $reqArticles = new ArticleDao();
        $articles = $reqArticles->getArticlesByCategory('all');
        include 'vue/articles.php';
    }

    public function getArticle($id) // get one article
    {
        $reqArticle = new ArticleDao();
        $article = $reqArticle->getSingleArticle($id);
        $comments = $this->getComments($id); // insérer les commentaires avec l'article
        include 'vue/commentForm.php';
    }

    /*******************
     * Front comments management
     **********************/
    public function getComments($id)
    {
        $comments = new CommentDao();
        $comments = $comments->getCommentsFromDb($id);
        return $comments;
    }

    /**
     * @param $articleId
     * @param $post
     */
    public function addComment($articleId, $postData)
    {
        $post = FormData::securizeFormFields($postData);
        $mySession = new Session();
        $nom = $mySession->get('user', 'nom');

        $comment = $post['comment'];
        $article = null;// init $article to use it as an array to display article datas
        $comments = null;// init comments to show all comments
        $commentErrorMessage = [];// Store error messages to be available into commentForm.php

        if (isset($post['commentFormBtn'])) {
            if (empty($post['comment'])) {
                $commentErrorMessage['contenu'] = Messages::setFlash("Attention !", "Commentaire non renseigné", 'warning');
            }
            if (empty($commentErrorMessage)) {
                //Ajouter le commentaire et le pseudo si le visiteur est enregistré
                $newComment = new Comments($post);
                $newComment->setPseudo($nom);
                $newComment->setContenu($comment);

                $commentObj = new CommentDao;
                $affectedLines = $commentObj->addCommentsToDb($articleId, $newComment); // id de l'article

                if ($affectedLines === false) {
                    $commentErrorMessage['contenu'] = Messages::setFlash("Super !", "Impossible d'ajouter le commentaire !", 'success');
                } else {
                    $commentErrorMessage['contenu'] = Messages::setFlash("Super !", "le commentaire est en attente de validation", 'success');
                }
            } else FormData::saveFormData('comment', $post);
        }
        //check if instance of Articles and Comments classes already exist
        // help to not create multiple instance
        if (($article instanceof ArticleDao) != true) {
            $reqArticle = new ArticleDao();
            $article = $reqArticle->getSingleArticle($articleId);
        } else {
            $article = $reqArticle->getSingleArticle($articleId);
        }
        if (($comments instanceof Comments) != true) {
            $comments = new CommentDao();
            $comments = $comments->getCommentsFromDb($articleId);
        } else {
            $comments->getCommentsFromDb($articleId);
        }
        include 'vue/commentForm.php';
    }

    /**
     *  list of articles management
     */
    public function getCategoryArticles($rubriq)
    {
        $articleDao = new ArticleDao(); //////////// voir gestion instance en Singleton
        $articles = $articleDao->getArticlesByCategory($rubriq);

        // Associer la vue correspondante à la rubrique sélectionnée
        if ($rubriq == "livres") {
            include 'vue/livres.php';

        } elseif ($rubriq == "fromages") {
            include 'vue/fromages.php';

        } else {
            header('Location: index.php');
        }
    }

    /**
     * Form contact management
     **/
    public function addContact($post)
    {
        $field = FormData::securizeFormFields($post);
        $checkInput = new  CheckContactInputs();
        $contactErrorMessage = $checkInput->checkContactInputs($field);

        FormData::saveFormData('input', $field);

        if ($field['formContact'] == 'sent') {
            if (empty($contactErrorMessage)) {

                /**
                 * Call class Emails to send contact form data
                 */
                $sendEmail = new Emails();
                $sendEmail->setNom($post['nom']);
                $sendEmail->setPrenom($post['prenom']);
                $sendEmail->setEmail($post['email']);
                $sendEmail->setMessage($post['message']);
                $sendEmail->sendEmail();
                $contactSendMessage = Messages::setFlash("Magnifique !", 'Email envoyé', 'success');
                FormData::cleanFormData('input', $post);
            }
        }
        include_once 'vue/home.php';
    }


    /**
     * acces to admin login page
     */
    public function logUser()
    {
        include 'vue/login.php';
    }


    /**
     *  acces to logAdmin.php  page
     */
    public function logAdmin()
    {
        include 'vue/logAdmin.php';
    }


    /**
     * access to register login page
     */
    public function register()
    {
        ImportPage::getPage(include 'vue/register.php');
    }

    /**
     *
     */
    public function logOff()
    {
        $session = new Session();
        $session->stop(); //unset($_SESSION);  session_destroy();

        header('Location: index.php');

    }

    /**
     * Before login check user presence in database
     */
    public function checkUser()//---- from login.php
    {
        $connexionErrorMessage = [];// Store error message to be available into login.php
        $input = new FormGlobals();
        $field = FormData::securizeFormFields($input->post());
        if (($field['formLogin']) == 'sent') {
            if (empty($field['login'])) {
                $connexionErrorMessage['login'] = Messages::setFlash("Attention !", "Pas de login renseigné", 'warning');
            }
            if (empty($field['password'])) {
                $connexionErrorMessage['password'] = Messages::setFlash("Attention !", "Pas de password renseigné", 'warning');
            } elseif (strlen($field['password']) < 2) {
                $connexionErrorMessage['password'] = Messages::setFlash("Attention !", "Le mot de passe doit avoir plus de 6 caractères!", 'warning');
            }
            //---- if no errors compare form fields data with those into the DB -----
            if (empty($connexionErrorMessage)) {
                $userData = new UserDao();
                $checkUser = $userData->checkUserLogin($field['login']);
                //---- check if user is registered ---------
                if (($checkUser['login'] === $field['login']) && password_verify($field['password'], $checkUser['password'])) {

                    if ($checkUser['statut'] == 1) {
                        $mySession = new Session();
                        $mySession->set('user', 'nom', $checkUser['nom']);
                        $mySession->set('user', 'role', $checkUser['role']);
                        $mySession->set('user', 'login', $checkUser['login']);
                        $mySession->set('user', 'email', $checkUser['email']);
                        $mySession->set('user', 'bienvenu', 1);

                        //------ check if user is admin --------
                        if ($mySession->get('user', 'role') === 'admin') {
                            //echo '<pre> sessionUserrole'; var_dump(Session::get('user', 'role'));
                            header('Location: index.php?route=admin'); // if user is admin go to admin page

                        } else {
                            header('Location: index.php');

                        }
                    } else {// statut = 0
                        $connexionErrorMessage['statut'] = Messages::setFlash("Attention !", "Votre compte n'est pas encore validé", 'warning');
                    }
                } else {
                    $connexionErrorMessage['loginOrPass'] = Messages::setFlash("Attention !", "Identifiants non correct", 'warning');
                }
            }
        }
        include_once 'vue/login.php';
    }

    /**
     * Add user from register.php to database
     **/
    public function addUser()
    {
        $input = new FormGlobals();
        $post = FormData::securizeFormFields($input->post());
        $registerFormMessage = []; // on initialise un tableau pour afficher les erreurs présentent dans les champs du formulaire
        $loginEmailFormMessage = []; //stocke erreur si login et email déjà utilisés

        if (!empty($post)) {
            if ($post['formRegister'] == 'sent') {
                $checkInput = new  CheckUserInputs();
                $registerFormMessage = $checkInput->checkUserInputs($input->post());

                FormData::saveFormData('register', $post);
                //---- if no errors in form fields add user's data are not yet in DB  ---
                //---- launch email checking with a token ----------------------
                if (empty($registerFormMessage)) {
                    $userDao = new UserDao();
                    $userLogin = $userDao->checkUserLogin($post['login']);
                    $userEmail = $userDao->checkUserEmail($post['email']);

                    if ($userLogin || $userEmail) {
                        if ($userLogin) {

                            $loginEmailFormMessage["registerForm"]["login"] = Messages::setFlash("Attention !", "Login déjà pris", "warning");
                        }

                        if ($userEmail) {
                            $loginEmailFormMessage["registerForm"]["email"] = Messages::setFlash("Attention !", "Email déjà pris", "warning");
                        }
                    } else {
                        $token = Emails::generateToken();
                        //instancier la classe qui envoie les données des utilisateurs vers la bdd
                        $user = new Users($post);
                        $user->setToken($token);
                        $userDao->addUserToDb($user);
                        $userEmail = $user->getEmail(); //"damir@romandie.com";
                        $createUrlToken = Emails::createUrlWithToken($token, $userEmail);
                        $anEmail = new Emails();
                        $anEmail->tokenEmail($userEmail, $createUrlToken); //in Emails.php class

                        $loginEmailFormMessage["registerForm"]["OK"] = Messages::setFlash("Génial !", "Email envoyé", "success");

                        FormData::cleanFormData('register', $post);

                    }
                }
            }
        }
        include 'vue/register.php';
    }


    /**
     * check the token from the link validate in the user's email
     */
    public function verifyToken()
    {
        $input = new FormGlobals();
        $registerMessage = [];
        if (!empty($input->get('token'))) // if got user's token from email
        {
            $userToken = trim($input->get('token'));//token from email
            $newUser = new UserDao();
            $result = $newUser->fetchToken($userToken);
            $noviUser = $newUser->validateUser($result['id']);
            if ($noviUser) {
                $registerMessage ['user'] = Messages::setFlash("Super !", "Vous êtes inscrit ", "success"); // Store error message to be abvailable into register.php
            }
            include_once 'vue/home.php';
        }
    }

    /**
     * contact from top menu
     **/
    public function errorsException($exception)
    {
        $errorException = $exception;
        include 'vue/errorsException.php';
    }
}
