<?php

require_once 'imports.php';

$articleManager = new ArticleManager();
$articles = $articleManager->getArticles();

//foreach ($articles as $article) {
//    /** @var $article Article */
//    echo $article->getTitle();
//}

/** @var $article Article */
$premierArticle = $articles[0];
$premierArticle->setTitle('mon nouveau titre');
$premierArticle->setContent('mon nouveau contenu');
$articleManager->update($premierArticle);

// add new article
$monArticle = new Article();
$monArticle->setTitle('Hello World');
$monArticle->setContent('Mon nouveau contenu');
$articleManager->insert($monArticle);
