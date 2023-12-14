<?php

require_once(__DIR__ . '/../../config/db.php');

class crud extends database
{
    private $sql;
    public function getArticles()
    {
        try {
            $this->sql = "SELECT * FROM article;";
            $stmt = $this->connexion()->prepare($this->sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                echo "empty";
            } else {
                foreach ($result as $row) {
                    echo "Article " . $row['Id'] . ":<hr style='width: 100px; margin-left: 0;'>";
                    echo $row['titre'] . "<br>";
                    echo $row['contenu'] . "<br>";
                    echo $row['date_de_creation'] . "<br>";
                    echo "By User: " . $row['user_id'] . "<hr style='width: 400px;'>";
                }
            }
        } catch (PDOException $e) {
            die("query failed: " . $e);
        }
    }

    public function addArticles($title, $content, $user_id)
    {

        $this->sql = "INSERT INTO `article`(`titre`, `contenu`, `date_de_creation`, `user_id`) VALUES (:titre, :contenu, NOW(), :user_id);";
        $stmt = $this->connexion()->prepare($this->sql);

        $stmt->bindParam(":titre", $title, PDO::PARAM_STR);
        $stmt->bindParam(":contenu", $content, PDO::PARAM_STR);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        $stmt->execute();

    }

    // public function delArticles() {

    //     $this->sql = "DELETE FROM article WHERE id = :idDel;";
    //     $stmt = $this->connexion()->prepare($this->sql);
    // }
}