<?php
require_once "database.php";
class Chat extends Database
{
    public function sendMessage($user_id, $chat_user_id, $text, $time)
    {
        $sql = "INSERT INTO chat (`user_id`,`chat_user_id`,`text`,`time`) VALUES ($user_id, $chat_user_id, '$text','$time');";
        if ($this->conn->query($sql)) {
            header("Location: ../views/chat.php?id=" . $chat_user_id);
            exit;
        } else {
            die('Error inserting message ' . $this->conn->error);
        }
    }

    public function getMessage($user_id, $chat_user_id)
    {
        $sql = "SELECT `user_id`,`text` from chat WHERE (user_id= $user_id AND chat_user_id = $chat_user_id) OR (user_id=$chat_user_id AND chat_user_id = $user_id )  ORDER BY `time`;";
        if ($result = $this->conn->query($sql)) {
            return $result;
        } else {
            die('error selecting message ' . $this->conn->error);
        }
    }
}
