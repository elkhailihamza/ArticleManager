<?php

require_once(__DIR__ . '/../../config/db.php');

class crud extends database
{
    private $sql;
    private $title;
    private $content;
    private $user_id;
    private $id;
    private $identifier;
    public function getArticles()
    {
        try {
            $this->sql = "SELECT * FROM article ORDER BY date_de_creation DESC;";
            $stmt = $this->connexion()->prepare($this->sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                echo "empty";
            } else {
                foreach ($result as $row) {
                    echo "Article " . $row['Id'] . ":<hr style='width: 100px; margin-left: 0;'>";
                    echo $row['titre'] . " - By User: " . $row['user_id'] . "<br>";
                    echo $row['date_de_creation'] . "<br>";
                    echo $row['contenu'] . "<br>";
                    ?>
                    <div class="d-flex gap-3 p-2">
                        <form action='./../includes/CRUD/del_form.php' method='POST'>
                            <input type="hidden" value="<?= $row['Id'] ?>" name="id">
                            <button class='btn btn-danger px-4' type='submit' name="submit" value='Submit'>Delete</button>
                        </form>
                        <form action='./upd_form.php' method='POST'>
                            <input type="hidden" value="<?= $row['Id'] ?>" name="id">
                            <button class='btn btn-success px-4' type='submit' name="submit" value='Submit'>Edit</button>
                        </form>
                    </div>
                    <?php
                    echo "<hr style='width: 400px;'>";
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

    public function delArticles($id)
    {
        $this->sql = "DELETE FROM article WHERE Id = :del;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":del", $id, PDO::PARAM_INT);

        $stmt->execute();

        return true;
    }

    public function updArticles($title, $content, $id)
    {
        $this->sql = "UPDATE `article` SET `titre`= :title  ,`contenu`= :content WHERE Id = :upd";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":content", $content, PDO::PARAM_STR);
        $stmt->bindParam(":upd", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function checker($identifier)
    {
        $this->identifier = $identifier;
        if (isset($_POST['submit'])) {
            $this->mapper();
        }
    }
    public function mapper()
    {
        $this->title = $_POST['title'];
        $this->content = $_POST['content'];
        $this->user_id = 1;

        if (!empty($this->title) && !empty($this->content)) {
            if ($this->identifier == 'insert') {
                $this->addArticles($this->title, $this->content, $this->user_id);
            } else if ($this->identifier == 'update') {
                $this->id = $_POST['id'];
                $this->updArticles($this->title, $this->content, $this->id);
            }
            header("Location: ./index.php");
        } else {
            die("Enter text in the fields specified!");
        }
    }
}