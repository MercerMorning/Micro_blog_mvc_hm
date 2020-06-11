<?php
namespace App\Controllers;
use App\Models\Message;
use App\Models\User;

class AdminController extends BaseController
{
    public function message()
    {
        $messageModel = new Message();
        if (!$messageModel->quest()){
            $message = $messageModel->user();
            $allMessages = $messageModel->getAllMessages();
            $ret = $messageModel->addMessage($message, $_POST["text"]);
            $del = $messageModel->deleteMessage(key($_GET));
            //$img = $messageModel->setImageToMessage($_FILES);
            if ($ret || $del) {
                header("Location: http://hmmvc/admin/message");
            }
            $this->render('front\messageAdmin', $allMessages);
        }
        return 0;
    }

}
