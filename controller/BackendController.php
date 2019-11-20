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
        $articleAdded = $article->addArticleToDb();
        echo 'articleAdded';// require 'vue/articles.php';

    }

    public function editArticle()
    {               
        $article = new Articles();
        $articlEdited = $article->singleArticle();
        echo 'articlEdited';// require 'vue/articles.php';

    }

    public function editListArticles()
    {               
        $articles = new Articles();
        $articlesEdited = $articles->getListArticles();
        require 'vue/backend/list_articles.php';

    }



}


