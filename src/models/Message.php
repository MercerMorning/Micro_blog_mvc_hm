<?php
namespace App\Models;

class Message extends Base
{
    public function getAllMessages()
    {
        $sql = "SELECT micro_blog_messages.id, text, date, name FROM micro_blog_messages INNER JOIN micro_blog ON micro_blog.id = micro_blog_messages.user_id";
        $statement = $this->getConnect()->prepare($sql);
        $ret = $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function setImageToMessage($file)
    {
        echo __DIR__ . "..\..\images\\" . $this->getLastInsertID() . ".jpg";
        $fileContent = file_get_contents($file["userfile"]["tmp_name"]);
        file_put_contents(__DIR__ . "../../../images/" . $this->getLastInsertID() . ".jpg", $fileContent);
    }

    public function getLastInsertID()
    {
        $sql = "SELECT id FROM `micro_blog_messages` ORDER BY id DESC LIMIT 1";
        $statement = $this->getConnect()->prepare($sql);
        $ret = $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC)["id"];
    }

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

    /*public function getAllMessages()
    {
        $sql = "SELECT * FROM `micro_blog_messages` ORDER BY id DESC LIMIT 3";
        $statement = $this->getConnect()->prepare($sql);
        $ret = $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }*/

    public function getAllMessagesById($id)
    {
        $sql = "SELECT text FROM `micro_blog_messages` WHERE user_id=:user_id";
        $statement = $this->getConnect()->prepare($sql);
        $ret = $statement->execute(["user_id" => $id]);
        return json_encode($statement->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function deleteMessage($id)
    {
        $sql = "DELETE FROM micro_blog_messages WHERE id=:id";
        $statement = $this->getConnect()->prepare($sql);
        $ret = $statement->execute(["id"=>$id]);
        echo $statement->rowCount();
    }
}