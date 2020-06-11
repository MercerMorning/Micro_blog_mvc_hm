<?php
namespace App\Models;

class Message extends Base
{
    public function addMessage($user, $text)
    {
        $sql = "INSERT INTO `micro_blog_messages` (text, `date`, user_id) VALUES (:text, :date, :user_id)";
        $statement = $this->getConnect()->prepare($sql);
        $ret = $statement->execute(["text" => $text,
            "date" => date("y.m.d"),
            "user_id" => $user["id"]
        ]);
        return $ret;
    }

    public function getAllMessages()
    {
        $sql = "SELECT * FROM `micro_blog_messages` LIMIT 20";
        $statement = $this->getConnect()->prepare($sql);
        $ret = $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllMessagesById($id)
    {
        $sql = "SELECT text FROM `micro_blog_messages` WHERE user_id=:user_id";
        $statement = $this->getConnect()->prepare($sql);
        $ret = $statement->execute(["user_id" => $id]);
        return json_encode($statement->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function deleteMessage($user, $text)
    {
        $sql = "INSERT INTO `micro_blog_messages` (text, `date`, user_id) VALUES (:text, :date, :user_id)";
        $statement = $this->getConnect()->prepare($sql);
        $ret = $statement->execute(["text" => $text,
            "date" => date("y.m.d"),
            "user_id" => $user["id"]
        ]);
        return $ret;
    }
}