<?php
namespace App\Models;

class User extends Base
{
    /**
     * Запрос пользователя по email
     * @param $email
     * @return bool
     */
    public function getUser($email)
    {
        $sql = "SELECT * FROM micro_blog WHERE `email` = :user_email";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute(["user_email" => $email]);
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function addUser($user)
    {
        $sql = "INSERT INTO micro_blog (email, password, `name`, register_date) VALUES (:email, :password, :name, :register_date)";
        $statement = $this->getConnect()->prepare($sql);
        $ret = $statement->execute(["email" => $_POST["email"],
                    "password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                    "name" => $_POST["name"],
                    "register_date" => date("y.m.d")
                ]);
        return $ret;
    }


//    public function getUser()
//    {
//        $answer = new Answer();
//        if ($answer->isFullRegInf()
//            && !$db->fetchAll("SELECT * FROM micro_blog WHERE email=:email AND `name`=:name", ["email" => $_POST["email"], "name" => $_POST["name"]], "rows")
//        ) {
//            $ret = $db->exec("INSERT INTO micro_blog (email, password, `name`, register_date)
//                        VALUES (:email, :password, :name, :register_date)", ["email" => $_POST["email"],
//                    "password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
//                    "name" => $_POST["name"],
//                    "register_date" => date("y.m.d")
//                ]
//            );
//            if ($ret) {
//                header("Location: login");
//            }
//        }
//    }

}
