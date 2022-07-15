<?php
class User {
    protected $pdo;

    function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function checkInput($var) {
        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stripcslashes($var);

        return $var;
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT `user_id`, `password` FROM `users` WHERE `email` = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $count = $stmt->rowCount();
        echo $password . "<br>";
        echo $user->password . "<br>";
        echo $count . "<br>";
        $hash = password_hash($password, PASSWORD_DEFAULT);
        echo $hash;
        var_export(password_verify($password, $hash));
        if($count === 1 && password_verify($password, $user->password)) {
            $_SESSION['user_id'] = $user->user_id;
            header('Location: home.php');
        }else {
            return false;
        }
    }

    public function userData($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id;");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function logout(){
        $_SESSION = array();
        session_destroy();
        header('Location: ../index.php');
    }
}
