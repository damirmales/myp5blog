<?php
namespace Controller;
use Model\Articles;

class BackendController
{
	//********** admin login page access *************

    public function admin()
    {        
        if ($_SESSION["user"]['role'] != 'admin')
        {

               header('Location: index.php'); // if user is not admin
               exit();    

               
         /*header('Location:index.php?route=admin'); 
         exit(); */
     }
     
     require 'vue/backend/admin_page.php'; 
     
     
     

 }

    //********** Manage articles *************

 public function createArticle()
 {               
    require 'vue/backend/create_article.php';//call addArticle() when form would be completed

}

public function addArticle()
{               
    $article = new Articles();

    $article->setTitre ( $_POST['titre'] );
    $article->setChapo ( $_POST['chapo'] );
    $article->setAuteur ( $_POST['auteur'] );
    $article->setContenu ( $_POST['contenu'] );
    $article->setRubrique ( $_POST['rubrique'] );
    $article->setDateCreation (date("d-m-Y"));
    $article->setDateMiseAJour ( date("d-m-Y"));

    $articleAdded = $article->setArticleToDb();
            echo 'articleAdded';
            require 'vue/articles.php';

        }

        public function editArticle($idArticle)
        {               
            $getArticle = new Articles();
            $article = $getArticle->getSingleArticle($idArticle);
         require 'vue/backend/show_article.php';

    }

    public function editListArticles()
    {               
        $articles = new Articles();
        $articlesEdited = $articles->getListArticles();
        require 'vue/backend/list_articles.php';

    }

    public function deleteArticle($idArticle)
    {               
        $articles = new Articles();
        $articleDeleted = $articles->deleteArticle($idArticle);
        

    }



}


