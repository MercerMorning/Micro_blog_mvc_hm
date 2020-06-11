<?php
namespace Base\DB;

use Cassandra\Date;
use PDO;

class DB
{
    private $pdo;

    private function getConnection()
    {
        if (!$this->_pdo) {
            $this->_pdo = new PDO('mysql:host=localhost;dbname=users_bd', "root", "root");
        }

        return $this->_pdo;
    }

    public function fetchAll(string $query, array $params = [], $return = "data")
    {
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);

        $ret = $prepared->execute($params);

        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}}: " . $errorInfo[2]);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();
        if ($return == "data") {
            return $data;
        }
        return $affectedRows;
    }

    public function fetchOne(string $query, array $params = [])
    {
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);

        $ret = $prepared->execute($params);

        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}}: " . $errorInfo[2]);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();
        if (!$data) {
            return false;
        }
        return reset($data);
    }

    public function exec(string $query, array $params = [])
    {
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);

        $ret = $prepared->execute($params);

        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return -1;
        }
        $affectedRows = $prepared->rowCount();
        return $affectedRows;
    }



    /*
    public function checkUser()
    {
        $pdo = $this->getConnection();
        $sql = "SELECT password FROM micro_blog WHERE email=:email";
        $prepared = $pdo->prepare($sql);
        $ret = $prepared->execute(["email" => $_POST["email"]]
            );
        return $prepared->fetch(PDO::FETCH_ASSOC)["password"];
    }

    public function checkRepeat($passwordHash):bool
    {
        $pdo = $this->getConnection();
        $sql = "SELECT * FROM micro_blog WHERE email=:email AND password=:password AND `name`=:name";
        $prepared = $pdo->prepare($sql);
        $ret = $prepared->execute(["email" => $_POST["email"],
            "password" => $passwordHash,
            "name" => $_POST["name"]]);
        return $prepared->rowCount();
    }

    public function getPasswordHash()
    {
        return password_hash($_POST["password"], PASSWORD_BCRYPT);
    }

    public function save()
    {
        $passwordHash = $this->getPasswordHash();
        $pdo = $this->getConnection();
        $sql = "INSERT INTO micro_blog (email, password, `name`, register_date) 
VALUES (:email, :password, :name, :register_date)";
        $prepared = $pdo->prepare($sql);
        $ret = $prepared->execute(["email" => $_POST["email"],
            "password" => $passwordHash,
            "name" => $_POST["name"],
            "register_date" => date("y.m.d")]);
        if ($ret) {
            return $prepared->fetch(PDO::FETCH_ASSOC);
        }
        return "Провал!";
    }

    public function getSave()
    {
        $pdo = $this->getConnection();
        $sql = "SELECT * FROM micro_blog WHERE email=:email AND `name`=:name";
        $prepared = $pdo->prepare($sql);
        $ret = $prepared->execute(["email" => $_POST["email"],
            "name" => $_POST["name"]]);
        return $prepared->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function writeMessage($userId)
    {
        $pdo = $this->getConnection();
        $sql = "INSERT INTO micro_blog_messages (text, `data`, user_id) 
VALUES (:text, :data, :user_id)";
        $prepared = $pdo->prepare($sql);
        $ret = $prepared->execute(["text" => $_POST["text"],
            "data" =>  date("y.m.d"),
            "user_id" => $userId]);
        return $prepared->fetchAll(PDO::FETCH_ASSOC);
    }
    */
}