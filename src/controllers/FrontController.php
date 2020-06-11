<?php
namespace App\Controllers;

use App\Models\Message;
use App\Models\User;
use Base\Answer\Answer;
use Base\DB\DB;

class FrontController extends BaseController
{

    public function register()
    {
        $this->render('front\register');
        if (!$_POST["name"]
            || !$_POST["email"]
            || !$_POST["password"]
            || !$_POST["password-repeat"]
            || !strlen($_POST["password"]) >= 4
            || !strlen($_POST["password-repeat"]) >= 4
            || !$_POST["password"] == $_POST["password-repeat"]) {
            return false;
        }
        $userModel = new User();
        $user = $userModel->getUser($_POST["email"]);
        if (!empty($user)) {
            return false;
        }
        $userModel->addUser($_POST);
    }

    public function login()
    {
        if ($_POST["email"] && $_POST["password"]) {
            $userModel = new User();
            $user = $userModel->getUser($_POST["email"]);
            if (password_verify($_POST["password"], $user["password"])) {
                $userModel->login($user);
                header("Location: http://hmmvc/user/message");
                exit();
            }
        } else {
            $this->render('front\login');
        }
    /*
        if ($db->fetchAll("SELECT * FROM micro_blog WHERE email=:email",
            [
                "email" => $_POST["email"]
            ],
            "rows")
        ) {
            if (password_verify($_POST["password"],
                $db->fetchOne(
                    "SELECT password FROM micro_blog WHERE email=:email",
                    ["email" => $_POST["email"]]
                )["password"])
            ) {
                $_SESSION["User"] = 123;
                header("Location: http://hmmvc/user/message");
                exit();
            }
        }
        $this->render('front\login', ['users' => $users]);
    */
    }

    public function message()
    {
        $messageModel = new Message();
        $message = $messageModel->user();
        if (in_array($messageModel->user()["id"],ADMIN_ID)) {
            $allMessages = $messageModel->getAllMessages();
            $this->render('front\messageAdmin', $allMessages);
            $messageModel->addMessage($message, $_POST["text"]);
            //$messageModel->deleteMessage($_POST["id"]);
        } elseif ($messageModel->quest()) {
            return false;
        } else {
            $allMessages = $messageModel->getAllMessages();
            $this->render('front\message', $allMessages);
            $messageModel->addMessage($message, $_POST["text"]);
        }
        //print($messageModel->getAllMessagesById(218));
    }


//    public function login()
//    {
//        $db = new DB();
//        echo $User->getName();
//        $User->getId();
//        $User->getRegisterDate();
//        $User->getEmail();
//        $User->getPasswordHash();
//        $model = new User();
//        $db = new DB();
//        $this->render('front\login', ['users' => $users]);
//        $passwordHash = $db->checkUser();
//        if (password_verify($_POST["password"], $passwordHash)) {
//            echo 'hi';
//            $this->message();
//        } else {
//            echo 'bye';
//        }
//    }
//
//    public function message()
//    {
//        global $User;
//
//        $this->render('front\message', ['users' => $users]);
//        $message = new Message()
//        $message->setId($User->getId());
//        echo $message->getId();
//    }
}