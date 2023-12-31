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
    protected $sessionManager;
    public function __construct(sessionManager $sessionManager)
    {
        parent::__construct();
        $this->sessionManager = $sessionManager;
    }
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
                        if ($this->sessionManager->getSession("role_id") == 2) {
                            if ($this->sessionManager->getSession("isAdmin")) {
                                ?>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <form action='./../includes/CRUD/del_form.php' method='POST'>
                                            <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                            <button class='btn btn-danger px-4' type="submit">Delete</button>
                                        </form>
                                        <form action='./upd_form.php' method='POST'>
                                            <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                            <button class='btn btn-success px-4' type="submit">Edit</button>
                                        </form>
                                    </div>
                                </td>
                                <?php
                            } else {
                                if ($row['username'] === $this->sessionManager->getSession("uname")) {
                                    ?>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <form action='./../includes/CRUD/del_form.php' method='POST'>
                                                <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                                <button class='btn btn-danger px-4' type="submit">Delete</button>
                                            </form>
                                            <form action='./upd_form.php' method='POST'>
                                                <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                                <button class='btn btn-success px-4' type="submit">Edit</button>
                                            </form>
                                        </div>
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td>
                                        <p>unavailable!</p>
                                    </td>
                                    <?php
                                }
                            }
                        } else if ($this->sessionManager->getSession("role_id") == 1) {
                            if ($this->sessionManager->getSession("isAdmin")) {
                                ?>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <form action='./../includes/CRUD/del_form.php' method='POST'>
                                                <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                                <button class='btn btn-danger px-4' type="submit">Delete</button>
                                            </form>
                                            <form action='./upd_form.php' method='POST'>
                                                <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                                <button class='btn btn-success px-4' type="submit">Edit</button>
                                            </form>
                                        </div>
                                    </td>
                                <?php
                            } else {
                                ?>
                                    <td>
                                        <p>unavailable!</p>
                                    </td>
                                <?php
                            }
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

        if($stmt->execute()) {
            return true;
        }
    }

    public function delArticles($id)
    {
        $this->sql = "DELETE FROM article WHERE id = :del;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":del", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function updArticles($title, $content, $id)
    {
        $this->sql = "UPDATE `article` SET `titre`= :title  ,`contenu`= :content WHERE id = :upd";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":content", $content, PDO::PARAM_STR);
        $stmt->bindParam(":upd", $id, PDO::PARAM_INT);
        if($stmt->execute()) {
            return true;
        }
    }
    public function checker($identifier)
    {
        $this->identifier = $identifier;
        if (isset($_POST['submit'])) {
            if ($this->mapper()) {
                echo '<script type="text/javascript">window.location.href="./view.php";</script>';
                exit();
            }
        }
        if ($this->sessionManager->getSession("role_id") == 1) {
            if($this->sessionManager->getSession("isAdmin") == false && ($identifier == "update" || $identifier == "insert")) {
                echo '<script type="text/javascript">window.location.href="./index.php";</script>';
                exit();
            } else if ($this->sessionManager->getSession("isAdmin") == true && $identifier == "insert") {
                echo '<script type="text/javascript">window.location.href="./index.php";</script>';
                exit();
            }
        }
    }
    public function mapper()
    {
        $this->user_id = $this->sessionManager->getSession("userid");
        $this->id = $this->sessionManager->getSession("id");
        if (isset($_POST['title']) && isset($_POST['content'])) {
            $this->title = $_POST['title'];
            $this->content = $_POST['content'];
            if (!empty($this->title) && !empty($this->content)) {
                if ($this->identifier == 'insert') {
                    if ($this->addArticles($this->title, $this->content, $this->user_id)) {
                        return true;
                    }
                } else if ($this->identifier == 'update') {
                    if ($this->updArticles($this->title, $this->content, $this->id)) {
                        return true;
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

class auth extends crud
{
    private $fname;
    private $lname;
    private $uname;
    private $pass;
    private $email;
    private $role_id;

    public function emailExists()
    {
        $this->sql = "SELECT * FROM utilisateur WHERE email = :email;";
        $stmt = $this->connexion()->prepare($this->sql);

        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function usernameExists()
    {
        $this->sql = "SELECT * FROM utilisateur WHERE username = :uname;";
        $stmt = $this->connexion()->prepare($this->sql);

        $stmt->bindParam(":uname", $this->uname, PDO::PARAM_STR);

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
                $this->sessionManager->setSession("userid", $row['id']);
                $this->sessionManager->setSession("fname", $row['firstname']);
                $this->sessionManager->setSession("lname", $row['lastname']);
                $this->sessionManager->setSession("uname", $row['username']);
                $this->sessionManager->setSession("email", $row['email']);
                $this->sessionManager->setSession("role_id", $row['role_id']);

                $this->sql = "SELECT * FROM administrateur WHERE user_id = :user_id;";
                $stmt = $this->connexion()->prepare($this->sql);
                $user_id = $this->sessionManager->getSession("userid");
                $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch();

                if (!empty($result)) {
                    $this->sessionManager->setSession("isAdmin", true);
                } else {
                    $this->sessionManager->setSession("isAdmin", false);
                }
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
        $this->uname = $_POST['uname'];

        $rs = $this->emailExists();
        $rs_data = $this->usernameExists();

        if (!empty($rs)) {
            exit("Email already in use!");
        } else if(!empty($rs_data)) {
            exit("username already in use!");
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

    public function checker($identifier)
    {
        parent::checker($identifier);
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