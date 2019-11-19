<?php
namespace Controller;
use Model\backend\Article;

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
        $article = new Article();
        $articleAdded = $article->addArticleToDb();
        echo 'articleAdded';// require 'vue/articles.php';

    }

    public function editArticle()
    {               
        $article = new Article();
        $articlEdited = $article->showArticle();
        echo 'articlEdited';// require 'vue/articles.php';

    }

    public function editListArticles()
    {               
        $articles = new Article();
        $articlesEdited = $articles->showListArticles();
        require 'vue/backend/list_articles.php';

    }



}


