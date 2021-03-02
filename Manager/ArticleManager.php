<?php

class ArticleManager
{
    private ?PDO $db;

    public function __construct() {
        $this->db = DB::getinstance();
    }

    /**
     * return all Articles
     */
    public function getArticles(){
        $articles = [];
        $stmt = $this->db->prepare("SELECT * FROM article");
        if($stmt->execute()){
            foreach ($stmt->fetchAll() as $item) {
                // create Article object
                // $articles[] = new Article($item['id'], $item['content'], $item['date_add']);
                $article = new Article($item['id']);
                $article // ->setId($item['id'])
                    ->setTitle($item['title'])
                    ->setContent($item['content'])
                    ->setDateAdd($item['date_add'])
                    ;
                $articles[] = $article;
            }
        }
        return $articles;
    }

    /**
     * Update an Article
     * @param Article $article
     */
    public function update(Article $article): bool {
        if($article->getId()){
            $stmt = $this->db->prepare("
            UPDATE article SET
                title = :title,
                content = :content
                WHERE id = :id
            ");

            $stmt->bindValue('title', $article->getTitle());
            $stmt->bindValue('content', $article->getContent());
            $stmt->bindValue('id', $article->getId());

            return $stmt->execute();
        }
        return false;
    }

    /**
     * @param Article $article
     * @return bool
     */
    public function insert(Article $article): bool {
        if(is_null($article->getId())){
            $stmt = $this->db->prepare("
            INSERT INTO article (title, content) VALUES (:title, :content)
            ");

            $stmt->bindValue('title', $article->getTitle());
            $stmt->bindValue('content', $article->getContent());

            $result = $stmt->execute();

//            $article = new Article($this->db->lastInsertId());
//            $article
//                ->setTitle()
//                ->setContent()

            return $stmt->execute();
        }
        return false;
    }

    public function delete(Article $article){
        if($article->getId()){
            $stmt = $this->db->prepare("
            DELETE FROM article WHERE id = :id
            ");

            $stmt->bindValue('id', $article->getId());

            return $stmt->execute();
        }
        return false;
    }
}
