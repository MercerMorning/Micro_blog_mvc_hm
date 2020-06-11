<?php
namespace App\Controllers;

use App\Models\Message;
use App\Models\User;
use Base\Answer\Answer;
use Base\DB\DB;

class FrontController extends BaseController
{
    private function validationRegisterForm(array $post)
    {
        $result = [];
        if (empty($post['name'])) {
            $result[] = 'name is empty';
        }
        if (empty($post['email'])) {
            $result[] = 'email is empty';
        }
        if (empty($post['password'])) {
            $result[] = 'password is empty';
        }
        if (mb_strlen($post['password']) < 4) {
            $result[] = 'password must be more than 4 characters';
        }
        if ($post['password'] !== $post['password2']) {
            $result[] = 'passwords don\'t match';
        }
        return $result;
    }

    public function register()
    {
        $error = $this->validationRegisterForm($_POST);
        if ($error) {
            $this->render('front\register', ['error' => $error]);
            return 0;
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
            if (!empty($_FILES["userfile"]["tmp_name"])) {
                $messageModel->setImageToMessage($_FILES);
            }
            $messageModel->deleteMessage(key($_GET));
        } elseif ($messageModel->quest()) {
            return false;
        } else {
            $userModel = new User();
            $allMessages = $messageModel->getAllMessages();
            $allUsers = $userModel->getUser();

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