<?php

require_once(__DIR__ . '/../../config/db.php');


class crud extends database
{
    protected $sql;
    private $title;
    private $content;
    private $user_id;
    private $id;
    protected $identifier;
    public function getArticles()
    {
        try {
            $this->sql = "SELECT a.id, a.titre, a.contenu, a.date_de_creation, u.username, u.role_id
            FROM article a
            INNER JOIN utilisateur u ON a.user_id = u.id
            ORDER BY a.date_de_creation DESC;";
            $stmt = $this->connexion()->prepare($this->sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                echo "empty";
            } else {
                foreach ($result as $row) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?= $row['id'] ?>
                        </th>
                        <td>
                            <?= $row['titre'] ?>
                        </td>
                        <td>
                            <?= $row['contenu'] ?>
                        </td>
                        <td>
                            <?= $row['date_de_creation'] ?>
                        </td>
                        <td>
                            <?= $row['username'] ?>
                        </td>
                        <?php
                        if ($row['role_id'] == 2) {
                            ?>
                    <th class="col-2" scope="col">Upd&Del</th>

                            <td>
                                <div class="d-flex justify-content-between">
                                <form action='./../includes/CRUD/del_form.php' method='POST'>
                                    <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                    <button class='btn btn-danger px-4' type='submit' name="submit" value='Submit'>Delete</button>
                                </form>
                                <form action='./upd_form.php' method='POST'>
                                    <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                    <button class='btn btn-success px-4' type='submit' name="submit" value='Submit'>Edit</button>
                                </form>
                                </div>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
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
        $this->sql = "DELETE FROM article WHERE id = :del;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":del", $id, PDO::PARAM_INT);

        $stmt->execute();

        return true;
    }

    public function updArticles($title, $content, $id)
    {
        $this->sql = "UPDATE `article` SET `titre`= :title  ,`contenu`= :content WHERE id = :upd";
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
$session = new sessionManager();

class auth extends crud
{
    private $fname;
    private $lname;
    private $uname;
    private $pass;
    private $email;
    private $role_id;
    private $sessionManager;

    public function __construct(sessionManager $sessionManager)
    {
        parent::__construct();
        $this->sessionManager = $sessionManager;
    }

    public function checker($identifier)
    {
        $this->identifier = $identifier;
        if (isset($_POST['submit'])) {
            $this->mapper();
        }
    }

    public function emailExists()
    {
        $this->sql = "SELECT * FROM utilisateur WHERE email = ?;";
        $stmt = $this->connexion()->prepare($this->sql);

        $stmt->bindParam(1, $this->email, PDO::PARAM_STR);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function login()
    {
        $this->email = $_POST['email'];
        $this->pass = $_POST['pass'];

        $result = $this->emailExists();

        if (!empty($result)) {
            $row = $result;
            $hashedPass = $row['password'];

            if (password_verify($this->pass, $hashedPass)) {
                $this->sessionManager->startSession();
                $this->sessionManager->setSession("role_id", $row['role_id']);
                $this->sessionManager->setSession("userid", $row['id']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function register()
    {

        $this->email = $_POST['email'];

        $result = $this->emailExists();

        if (!empty($result)) {
            exit("Email already in use!");
        } else {
            $this->fname = $_POST['fname'];
            $this->lname = $_POST['lname'];
            $this->uname = $_POST['uname'];
            $this->pass = $_POST['pass'];

            $hashedPass = password_hash($this->pass, PASSWORD_DEFAULT);

            $this->role_id = 1;

            $this->sql = "INSERT INTO `utilisateur`(`firstname`, `lastname`, `username`, `password`, `email`, `role_id`) VALUES (:fname,:lname,:uname,:pass,:email,:role_id);";
            $stmt = $this->connexion()->prepare($this->sql);

            $stmt->bindParam(":fname", $this->fname, PDO::PARAM_STR);
            $stmt->bindParam(":lname", $this->lname, PDO::PARAM_STR);
            $stmt->bindParam(":uname", $this->uname, PDO::PARAM_STR);
            $stmt->bindParam(":pass", $hashedPass, PDO::PARAM_STR);
            $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
            $stmt->bindParam(":role_id", $this->role_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: ./login.php");
            }
        }
    }

    public function logout()
    {
        $this->sessionManager->startSession();
        $this->sessionManager->destroySession();
        return true;
    }

    public function mapper()
    {
        if ($this->identifier === 'login') {
            if ($this->login()) {
                header("Location: ./index.php");
            } else {
                exit("Error");
            }
        } else if ($this->identifier === 'register') {
            if ($this->register()) {
                header("Location: ./login.php");
            } else {
                exit("Error");
            }
        }
    }
}

class sessionManager
{
    public function startSession()
    {
        session_start();
    }
    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public function unsetSession($key)
    {
        unset($_SESSION[$key]);
    }
    public function getSession($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    public function destroySession()
    {
        session_destroy();
    }
}