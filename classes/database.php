<?php

class Database
{
    private $server_name = "localhost";
    private $username = "root";
    private $password = ""; //For MAMP user,root
    private $db_name = "print";/////////ここを作ったデータベースの名前にする
    protected $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);

        //privateのconnをエラーの内容を表す文字列を返します。エラーが発生しなかった場合は null を返します
        if ($this->conn->connect_error) {
            die("Unable to connect to database " . $this->db_name . ":" . $this->conn->connect_error);
        }
    }
}
