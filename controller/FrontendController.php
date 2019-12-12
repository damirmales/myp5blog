<?php

namespace Controller;

use Model\CommentDao;
use Model\PdoConstruct;
use Model\Articles;
use Model\ArticleDao;
use Model\Comments;
use Model\Users;
use Model\UserDao;
use Services\Emails;
use Services\ValidateForms;

require_once('services/Emails.php');
require_once('services/ValidateForms.php');
require_once('functions/functions.php');
require_once('functions/securizeFormFields.php');
require_once('functions/checkFormFields.php');

class FrontendController
{

    /******************* home management **********************/
    public function home()
    {
        require 'vue/home.php';
    }

    /******************* cv  **********************/
    public function cv()
    {
        require 'vue/cv.php';
    }

    /******************* contact from top menu  **********************/
    public function contact()
    {
        require 'vue/home.php';
    }

    /******************* Front articles.php management **********************/

    public function pullListeArticles() // get all articles
    {
        $reqArticles = new ArticleDao(); //////////// voir gestion instance en Singleton
        $articles = $reqArticles->getListArticles();
        require 'vue/articles.php';
    }

    public function getArticle($id) // get one article
    {
        $reqArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
        $article = $reqArticle->getSingleArticle($id);
        $comments = $this->getComments($id); // insérer les commentaires avec l'article

        require 'vue/commentForm.php';
    }

    /******************* Front comments management **********************/

    public function getComments($id)
    {
        $comments = new CommentDao();
        $comments = $comments->getCommentsFromDb($id);
        return $comments;
    }

    public function addComment($articleId, $post)
    {
        $nom = $_SESSION['user']['nom'];
        $email = $_SESSION['user']['email'];
        $comment = $post['comment'];


        $article = null;// init $article to use it as an array to display article datas
        $comments = null;// init comments to show all comments

        $commentErrorMessage = [];// Store error messages to be available into commentForm.php
        $commentErrorID = [];

        if (isset($post['commentFormBtn'])) {

            if (empty($post['comment'])) {
                $commentErrorMessage ['contenu'] = setFlash("Attention !", "Commentaire non renseigné", 'warning');;;
            }

            if (empty($commentErrorMessage)) {


                //Ajouter le commentaire et le pseudo si le visiteur est enregistré
                $newComment = new Comments($post);
                $newComment->setPseudo($nom);
                $newComment->setContenu($comment);

                $commentObj = new CommentDao;
                $affectedLines = $commentObj->addCommentsToDb($articleId, $newComment); // id de l'article

                if ($affectedLines === false) {
                    //die('Impossible d\'ajouter le commentaire !');
                    exit('Impossible d\'ajouter le commentaire !');
                } else {
                    //$_SESSION['user']['role'] = 'member'; // intialize session to the logged user
                    echo 'commentaire en attente de validation';
                    /*header('Location: index.php?route=article&id=' . $articleId);
                    exit();*/
                }

            } else {
                saveFormData('comment');
            }

        }
        //------- check if instance of Articles and Comments classes already exist -------
        if (($article instanceof ArticleDao) != true) {
            $reqArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
            $article = $reqArticle->getSingleArticle($articleId);

        } else {
            // $article->getSingleArticle($articleId);
            $article = $reqArticle->getSingleArticle($articleId);
        }

        if (($comments instanceof Comments) != true) {

            $comments = new CommentDao();
            $comments = $comments->getCommentsFromDb($articleId);
        } else {
            $comments->getCommentsFromDb($articleId);
        }

        require 'vue/commentForm.php';
    }

    /******************* Front articles.php categories management **********************/

    public function getCategoryArticles($rubriq)
    {
        $post = $_POST;
        // récupérer les articles.php selon la rubrique désirée

        $articleDao = new ArticleDao(); //////////// voir gestion instance en Singleton

        $rubriques = $articleDao->getArticlesByCategory($rubriq);

        // Associer la vue correspondante à la rubrique sélectionnée
        if ($rubriq == "livres") {
            require 'vue/livres.php';

        } elseif ($rubriq == "fromages") {
            require 'vue/fromages.php';

        } else {
            header('Location: index.php');
            exit();
        }

    }
    /******************************************************************/
    /******************* Form contact management **********************/

    public function addContact($post)
    {
        //$validContact = new ValidateForms;
        //print_r($validContact->verifyEmptiness($post));

        /******** Contact form check ****************/
        $contactErrorMessage = [];// Store error message to be available into home.php
        $contactErrorMessage2 = "";// Store error message to be available into home.php

        //------------- sanitize input fields values -----------------------------
        $field = securizeFormFields($post);
        saveFormData('input');

        if ($field['formContact'] == 'sent') {

            if (empty($field['nom'])) {
                $contactErrorMessage['nom'] = setFlash("Attention !", "Nom non renseigné", "warning"); // Store error message to be abvailable into register.php
            } elseif (strlen($field['nom']) < 3) {
                $contactErrorMessage['nom'] = setFlash("Attention !", 'Votre nom doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($field['nom']) > 45) {
                $contactErrorMessage['nom'] = setFlash("Attention !", 'Votre nom doit faire moins de 45 caractères', 'warning');
            }

            if (empty($field['prenom'])) {
                $contactErrorMessage['prenom'] = setFlash("Attention !", "prenom non renseigné", "warning"); // Store error message to be abvailable into register.php
            } elseif (strlen($field['prenom']) < 3) {
                $contactErrorMessage['prenom'] = setFlash("Attention !", 'Votre prenom doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($field['prenom']) > 45) {
                $contactErrorMessage['prenom'] = setFlash("Attention !", 'Votre prenom doit faire moins de 45 caractères', 'warning');
            }


            if (empty($field['email'])) {
                $contactErrorMessage['email'] = setFlash("Attention !", "Email non renseigné", 'warning');
            } elseif (!filter_var($field['email'], FILTER_VALIDATE_EMAIL)) {
                $contactErrorMessage['email'] = setFlash("Attention !", "L'email doit être selon format :bibi@fricotin.fr", 'warning');
            }


            if (empty($field['message'])) {
                $contactErrorMessage['message'] = setFlash("Attention !", "Le message manque", 'warning');
            }

            if (empty($contactErrorMessage)) {


                /***** Call class Emails to send contact form data*/
                $sendEmail = new Emails();

                $sendEmail->setNom($post['nom']);
                $sendEmail->setPrenom($post['prenom']);
                $sendEmail->setEmail($post['email']);
                $sendEmail->setMessage($post['message']);

                $email = $sendEmail->sendEmail();

                $contactErrorMessage2 = setFlash("Magnifique !", 'Email envoyé', 'success');

            }

        }

        require_once 'vue/home.php';


    }
    /**************** a mettre dans un gestionnaire d'outils ***********
     * public function messageEmailContactOK($emel)
     * {
     * if ($emel == true) {
     * $_SESSION["contactFormOK"] = "function messageEmailContactOK email envoyé";
     * //$messageSend = "email envoyé";
     *
     * header('Location: index.php');
     * exit();
     *
     * } else {
     * $_SESSION["contactFormKO"] = "email non envoyé";
     * //$noMessageSend = "messageEmailContactOK email non envoyé";
     * }
     * }
     */


    //********** acces admin login page *************

    public function logUser()
    {
        require 'vue/login.php';

    }

    //********** acces logAdmin.php  page *************

    public function logAdmin()
    {

        require 'vue/logAdmin.php';

    }

    //********** acces register login page *************

    public
    function register()
    {
        require 'vue/register.php';

    }

    public
    function logOff()
    {
        unset($_SESSION);
        session_destroy();
        header('Location: index.php');
        exit();
    }

    /**************************************************************************/
    /******************* Before login check user presence in database *********/

    //---- from login.php ---------

    public function checkUser()
    {

        $connexionErrorMessage = [];// Store error message to be available into login.php
        //------------- sanitize input fields values -----------------------------
        $field = securizeFormFields($_POST);

        if (($field['formLogin']) == 'sent') {

            if (empty($field['login'])) {

                $connexionErrorMessage['login'] = setFlash("Attention !", "Pas de login renseigné", 'warning');
            }

            if (empty($field['password'])) {
                $connexionErrorMessage['password'] = setFlash("Attention !", "Pas de password renseigné", 'warning');

            }

            //---- if no errors compare form fields data with those into the DB -----
            if (empty($connexionErrorMessage)) {

                $userData = new UserDao();
                $checkUser = $userData->checkUserLogin($_POST['login']);


                //---- check if user is registered ---------
                if (($checkUser['login'] === $field['login']) && password_verify($field['password'], $checkUser['password'])) {

                    if ($checkUser['statut'] == 1) {
                        $_SESSION["user"]['role'] = $checkUser['role'];
                        $_SESSION["user"]['nom'] = $checkUser['nom'];
                        $_SESSION["user"]['login'] = $checkUser['login'];
                        $_SESSION["user"]['email'] = $checkUser['email'];
                        $_SESSION["user"]['bienvenu'] = 1;

                        //------ check if user is admin --------
                        if ($checkUser['role'] == 'admin') {

                            header('Location: index.php?route=admin'); // if user is admin go to admin page
                            exit();

                        } else {
                            $_SESSION["userName"] = "Vous êtes member";

                            header('Location: index.php?route=liste');
                            exit();
                        }
                    }
                    else // statut = 0
                    {
                        $_SESSION["loginForm"] = "Votre compte n'est pas encore validé";

                        header('Location: index.php');
                        exit();
                    }
                } else {

                    //$_SESSION["loginForm"] = "Problème avec le login ou le mot de passe réessayez";
                    $connexionErrorMessage['loginOrPass'] = setFlash("Attention !", "Problème avec le login ou le mot de passe réessayez", 'warning');

                    // header('Location: index.php');
                    // exit();

                }
            }

        }
        require_once 'vue/login.php';
    }


    //** check user's role ********
    public
    function userRole($role)
    {

        if (($role['role'] === 'admin') && ($role['statut'] == 1)) {
            echo '$role est admin';

            return 'admin';
        } elseif (($role['role'] === 'member') && ($role['statut'] == 1)) {
            echo '$role est member';
            return 'member';
        } else {
            echo '$role n\'est ni member ni admin';
            return false;
        }
    }

    /**********************************************************************************/
    /******************* Add user from register.php to database  **********************/

    public function addUser()
    {
        unset($_SESSION["registerFormOK"]);

        $post = securizeFormFields($_POST);
        /******** Contact form check ****************/

        $registerFormMessage = []; // on initialise un tableau pour afficher les erreurs dans les champs du formulaire

        if (!empty($post)) {

            if ($post['formRegister'] == 'sent') {
                if (empty($post['nom'])) {
                    $registerFormMessage['nom'] = setFlash("Attention !", "rien ds le nom", "warning"); // Store error message to be abvailable into register.php
                } elseif (strlen($post['nom']) < 3) {
                    $registerFormMessage['nom'] = setFlash("Attention !", 'Votre nom doit faire plus de 3 caractères', 'warning');
                } elseif (strlen($post['nom']) > 45) {
                    $registerFormMessage['nom'] = setFlash("Attention !", 'Votre nom doit faire moins de 45 caractères', 'warning');
                }

                if (empty($post['prenom'])) {

                    $registerFormMessage['prenom'] = setFlash("Attention !", "rien ds le prenom", "warning"); // Store error message to be abvailable into register.php

                } elseif (strlen($post['prenom']) < 3) {
                    $registerFormMessage['prenom'] = setFlash("Attention !", 'Votre prenom doit faire plus de 3 caractères', 'warning');
                } elseif (strlen($post['prenom']) > 45) {
                    $registerFormMessage['prenom'] = setFlash("Attention !", 'Votre prenom doit faire moins de 45 caractères', 'warning');
                }

                if (empty($post['email'])) {
                    $registerFormMessage['email'] = setFlash("Attention !", "rien ds le email", "warning"); // Store error message to be abvailable into register.php

                } elseif (!empty($post['email']) && !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                    $registerFormMessage['email'] = setFlash("Attention !", "L'email doit être selon format :bibi@fricotin.fr", "warning");

                }

                if (empty($post['login'])) {
                    $registerFormMessage['login'] = setFlash("Attention !", "rien ds le login", "warning"); // Store error message to be abvailable into register.php

                }

                if (empty($post['password'])) {
                    $registerFormMessage['password'] = setFlash("Attention !", "rien ds le Mot de passe ", "warning"); // Store error message to be abvailable into register.php

                }

                if (empty($post['password2'])) {
                    $registerFormMessage ['password2'] = setFlash("Attention !", "rien ds le répéter mot de passe ", "warning"); // Store error message to be abvailable into register.php

                }

                if (($post['password2']) !== ($post['password'])) {
                    $registerFormMessage['password12'] = setFlash("Attention !", "les champs des mots de passe doivent être identiques", "warning"); // Store error message to be abvailable into register.php

                }

                saveFormData('register');
                //--------------------------------------------------------------
                //---- if no errors in form fields add user's data in DB and ---
                //---- launch email checking with a token ----------------------

                if (empty($registerFormMessage)) {
                    $userDao = new UserDao();
                    $userLogin = $userDao->checkUserLogin($post['login']);
                    $userEmail = $userDao->checkUserEmail($post['email']);

                    if ($userLogin || $userEmail) {
                        echo 'doublon';
                    }
                    else {


                        echo '<pre> adduser';  var_dump($userLogin);
                        $token = generateToken();

                        //instancier la classe qui envoie les données des utilisateurs vers la bdd

                        $user = new Users($post);
                        $user->setToken($token);


                        $userInDb = $userDao->addUserToDb($user);


                        $userEmail = $user->getEmail(); //"damir@romandie.com";

                        $createUrlToken = createUrlWithToken($token);

                        $anEmail = new Emails();
                        $anEmail->tokenEmail($userEmail, $createUrlToken); //in Emails.php class
                        $_SESSION["registerFormOK"] = "email envoyé";

                        header('Location: index.php');
                        exit();

                    }
                }
            }
        }
        $_SESSION["registerFormOK"] = "ya un bleme";
        require 'vue/register.php';

    }

//*********** check the token from the link validate in the user's email **************
    public function verifyToken()
    {
        $registerMessage = [];
        if (isset($_GET['token']) && !empty($_GET['token'])) // if got user's token from email
        {
            $userToken = trim($_GET['token']);//token from email

            $newUser = new UserDao();

            $result = $newUser->fetchToken($userToken);

            $noviUser = $newUser->validateUser($result['id']);;
            if ($noviUser) {
                $registerMessage ['user'] = setFlash("Super !", "Vous êtes inscrit ", "success"); // Store error message to be abvailable into register.php

            }
            require_once 'vue/home.php';
            //header('Location: index.php');
            //exit();
        }
    }

}
