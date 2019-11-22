<?php
namespace Controller;
use Model\Articles;

class BackendController
{
	//********** acces admin login page *************

    public function admin()
    {               
        require 'vue/backend/admin_page.php'; 

    }

    public function createArticle()
    {               
        require 'vue/backend/create_article.php';

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
            echo 'articleAdded';// require 'vue/articles.php';

    }

    public function editArticle()
    {               
        $article = new Articles();
        $articlEdited = $article->getSingleArticle();
        echo 'articlEdited';// require 'vue/articles.php';

    }

    public function editListArticles()
    {               
        $articles = new Articles();
        $articlesEdited = $articles->getListArticles();
        require 'vue/backend/list_articles.php';

    }


}


