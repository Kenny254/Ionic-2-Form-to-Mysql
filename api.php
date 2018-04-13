<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

class Mobile {

    function __construct() {
    try {
        $this->conn = new PDO("mysql:host=localhost;dbname=users", "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    }

    public function getAllusers(){
        $stmt = $this->conn->prepare("SELECT * FROM users"); 
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $this->mobiles= $stmt->fetchAll();          
        return $this->mobiles;
    }

    public function getUser($id){
        $stmt = $this->conn->prepare("SELECT * FROM users where id = '$id'"); 
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        return $stmt->fetchAll();
    }   

    public function delUser($id){
        $stmt = $this->conn->prepare("delete FROM users where id = '$id'"); 
        $stmt->execute();
    }

    public function insUser(){

        $data = json_decode($_POST['data'], true);

        $stmt = $this->conn->prepare("INSERT INTO `users` (`name`, `last_name`, `gender`, `email`, `password`, `ip_address`, `avatar`) VALUES (\"{$data['name']}\", \"{$data['last_name']}\", \"{$data['gender']}\", \"{$data['email']}\", \"{$data['password']}\", \"{$data['ip_address']}\", \"{$data['avatar']}\");"); 
        $stmt->execute();
    }

    public function updUser($id){
        $stmt = $this->conn->prepare("UPDATE users
SET name = \"{$_POST['name']}\", last_name= \"{$_POST['last_name']}\", gender = \"{$_POST['gender']}\" ,  email = \"{$_POST['email']}\", password = \"{$_POST['password']}\", ip_address= \"{$_POST['ip_address']}\", avatar= \"{$_POST['avatar']}\ WHERE id = $id;"); 
        $stmt->execute();
    }           

}
?>

/*
Making changes in

let postParams ='name='+ this.name + '&last_name=' + this.lname + '&email=' + this.email + '&gender=' + this.gender +
    '&password=' + this.pass + '&ip_address=' + this.ip + '&avatar=' + this.avatar;*/
    
    Also make changes in
    
    public function insUser(){
$stmt = $this->conn->prepare("INSERT INTO `users` (`name`, `last_name`, `gender`, `email`, `password`, `ip_address`, `avatar`) VALUES (\"{$_POST['name']}\", \"{$_POST['last_name']}\", \"{$_POST['gender']}\", \"{$_POST['email']}\", \"{$_POST['password']}\", \"{$_POST['ip_address']}\", \"{$_POST['avatar']}\");"); 
        $stmt->execute();
    }
