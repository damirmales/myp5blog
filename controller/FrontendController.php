<?php

namespace Controller;

use Model\CommentDao;
use Model\ArticleDao;
use Model\Comments;
use Model\Users;
use Model\UserDao;
use Services\Emails;
use Services\FormData;
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
        $reqArticles = new ArticleDao(); //////////// voir gestion instance en Singleton
        $articles = $reqArticles->getListArticles();
        include 'vue/articles.php';
    }

    public function getArticle($id) // get one article
    {
        $reqArticle = new ArticleDao(); // voir gestion instance en Singleton
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
        $nom = $_SESSION['user']['nom']; //use logged user's name
        $email = $_SESSION['user']['email'];//use logged user's email
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
                    exit('Impossible d\'ajouter le commentaire !');
                } else {
                    $_SESSION['waitingValidation'] = Messages::setFlash("Super !", "le commentaire est en attente de validation", 'success');
                }
            } else FormData::saveFormData('comment', $post);
        }
        //check if instance of Articles and Comments classes already exist
        // help to not create multiple instance
        if (($article instanceof ArticleDao) != true) {
            $reqArticle = new ArticleDao(); //////////// voir gestion instance en Singleton
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
     * Front articles.php categories management
     */
    public function getCategoryArticles($rubriq)
    {
        $articleDao = new ArticleDao(); //////////// voir gestion instance en Singleton
        $rubriques = $articleDao->getArticlesByCategory($rubriq);

        // Associer la vue correspondante à la rubrique sélectionnée
        if ($rubriq == "livres") {
            include 'vue/livres.php';

        } elseif ($rubriq == "fromages") {
            include 'vue/fromages.php';

        } else {
            header('Location: index.php');
            exit();
        }
    }

    /**
     * Form contact management
     **/
    public function addContact($post)
    {
        $contactErrorMessage = [];// Store error message to be available into home.php
        $field = FormData::securizeFormFields($post);
        FormData::saveFormData('input', $field);
        if ($field['formContact'] == 'sent') {
            if (empty($field['nom'])) {
                $contactErrorMessage['nom'] = Messages::setFlash("Attention !", "Nom non renseigné", "warning"); // Store error message to be abvailable into register.php
            } elseif (strlen($field['nom']) < 3) {
                $contactErrorMessage['nom'] = Messages::setFlash("Attention !", 'Votre nom doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($field['nom']) > 45) {
                $contactErrorMessage['nom'] = Messages::setFlash("Attention !", 'Votre nom doit faire moins de 45 caractères', 'warning');
            }
            if (empty($field['prenom'])) {
                $contactErrorMessage['prenom'] = Messages::setFlash("Attention !", "prenom non renseigné", "warning"); // Store error message to be abvailable into register.php
            } elseif (strlen($field['prenom']) < 3) {
                $contactErrorMessage['prenom'] = Messages::setFlash("Attention !", 'Votre prénom doit faire plus de 3 caractères', 'warning');
            } elseif (strlen($field['prenom']) > 45) {
                $contactErrorMessage['prenom'] = Messages::setFlash("Attention !", 'Votre prénom doit faire moins de 45 caractères', 'warning');
            }
            if (empty($field['email'])) {
                $contactErrorMessage['email'] = Messages::setFlash("Attention !", "Email non renseigné", 'warning');
            } elseif (!filter_var($field['email'], FILTER_VALIDATE_EMAIL)) {
                $contactErrorMessage['email'] = Messages::setFlash("Attention !", "L'email doit être selon format :bibi@fricotin.fr", 'warning');
            }
            if (empty($field['message'])) {
                $contactErrorMessage['message'] = Messages::setFlash("Attention !", "Le message manque", 'warning');
            }
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

    //********** acces admin login page *************
    public function logUser()
    {
        include 'vue/login.php';
    }

    //********** acces logAdmin.php  page *************
    public function logAdmin()
    {
        include 'vue/logAdmin.php';
    }

    //********** acces register login page *************

    public function register()
    {
        ImportPage::getPage(include 'vue/register.php');
    }

    public function logOff()
    {
        unset($_SESSION);
        session_destroy();
        header('Location: index.php');
        exit();
    }

    /**
     * Before login check user presence in database
     */
    public function checkUser()//---- from login.php ---------
    {
        $connexionErrorMessage = [];// Store error message to be available into login.php
        $field = FormData::securizeFormFields($_POST);
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
                        $session = &$_SESSION;
                        $session["user"]['role'] = $checkUser['role'];
                        $session["user"]['nom'] = $checkUser['nom'];
                        $session["user"]['login'] = $checkUser['login'];
                        $session["user"]['email'] = $checkUser['email'];
                        $session["user"]['bienvenu'] = 1;
                        //------ check if user is admin --------
                        if ($session["user"]['role'] === 'admin') {
                            //echo '<pre> sessionUserrole'; var_dump(Session::get('user', 'role'));
                            header('Location: index.php?route=admin'); // if user is admin go to admin page
                            exit();
                        } else {
                            header('Location: index.php');
                            exit();
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
        $post = FormData::securizeFormFields($_POST);
        $registerFormMessage = []; // on initialise un tableau pour afficher les erreurs présentent dans les champs du formulaire
        $loginEmailFormMessage = []; //si login et email déjà utilisés

        if (!empty($post)) {
            if ($post['formRegister'] == 'sent') {
                if (empty($post['nom'])) {
                    $registerFormMessage['nom'] = Messages::setFlash("Attention !", "Manque le nom", "warning"); // Store error message to be abvailable into register.php
                } elseif (strlen($post['nom']) < 3) {
                    $registerFormMessage['nom'] = Messages::setFlash("Attention !", 'Votre nom doit faire plus de 3 caractères', 'warning');
                } elseif (strlen($post['nom']) > 45) {
                    $registerFormMessage['nom'] = Messages::setFlash("Attention !", 'Votre nom doit faire moins de 45 caractères', 'warning');
                }

                if (empty($post['prenom'])) {
                    $registerFormMessage['prenom'] = Messages::setFlash("Attention !", "Manque le prénom", "warning"); // Store error message to be abvailable into register.php
                } elseif (strlen($post['prenom']) < 3) {
                    $registerFormMessage['prenom'] = Messages::setFlash("Attention !", 'Votre prénom doit faire plus de 3 caractères', 'warning');
                } elseif (strlen($post['prenom']) > 45) {
                    $registerFormMessage['prenom'] = Messages::setFlash("Attention !", 'Votre prénom doit faire moins de 45 caractères', 'warning');
                }

                if (empty($post['email'])) {
                    $registerFormMessage['email'] = Messages::setFlash("Attention !", "Manque l'email", "warning"); // Store error message to be abvailable into register.php
                } elseif (!empty($post['email']) && !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                    $registerFormMessage['email'] = Messages::setFlash("Attention !", "L'email doit être selon format :bibi@fricotin.fr", "warning");
                }

                if (empty($post['login'])) {
                    $registerFormMessage['login'] = Messages::setFlash("Attention !", "Manque le login", "warning"); // Store error message to be abvailable into register.php
                }

                if (empty($post['password'])) {
                    $registerFormMessage['password'] = Messages::setFlash("Attention !", "Manque le Mot de passe ", "warning"); // Store error message to be abvailable into register.php
                } elseif (strlen($post['password']) < 2) {
                    $registerFormMessage['password'] = Messages::setFlash("Attention !", "Le mot de passe doit avoir plus de 2 caractères!", 'warning');
                }
                if (empty($post['password2'])) {
                    $registerFormMessage ['password2'] = Messages::setFlash("Attention !", "Il faut répéter mot de passe ", "warning"); // Store error message to be abvailable into register.php
                }

                if (($post['password2']) !== ($post['password'])) {
                    $registerFormMessage['password12'] = Messages::setFlash("Attention !", "Les champs des mots de passe doivent être identiques", "warning"); // Store error message to be abvailable into register.php
                }

                FormData::saveFormData('register', $post);
                //---- if no errors in form fields add user's data are not yet in DB  ---
                //---- launch email checking with a token ----------------------
                if (empty($registerFormMessage)) {
                    $userDao = new UserDao();
                    $userLogin = $userDao->checkUserLogin($post['login']);
                    $userEmail = $userDao->checkUserEmail($post['email']);

                    if ($userLogin || $userEmail) {
                        if ($userLogin) {
                            //$_SESSION["registerForm"]["login"] = Messages::setFlash("Attention !", "Login déjà pris", "warning");
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
                        $_SESSION["registerForm"]["OK"] = Messages::setFlash("Génial !", "Email envoyé", "success");

                        header('Location: index.php?route=register');
                        exit();
                    }
                }
            }
        }
        include 'vue/register.php';
    }

    //check the token from the link validate in the user's email
    public function verifyToken()
    {
        $registerMessage = [];
        if (isset($_GET['token']) && !empty($_GET['token'])) // if got user's token from email
        {
            $userToken = trim($_GET['token']);//token from email
            $newUser = new UserDao();
            $result = $newUser->fetchToken($userToken);
            $noviUser = $newUser->validateUser($result['id']);
            if ($noviUser) {
                $registerMessage ['user'] = Messages::setFlash("Super !", "Vous êtes inscrit ", "success"); // Store error message to be abvailable into register.php
            }
            include_once 'vue/home.php';
        }
    }
}
