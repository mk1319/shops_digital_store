<?php
//create table register(id int not null auto_increment,primary key(id),name varchar(50),email varchar(50),shoptype varchar(100),password varchar(20),data datetime default current_timestamp)
//create table shop(shopid int not null auto_increment,primary key(shopid),name varchar(100),Address varchar(100),city varchar(100),state varchar(100),image varchar(100),id int ,foreign key(id) references register(id))

$servername = "localhost";
$username = "root1";
$password = "1234";
try {
    $connect= new PDO("mysql:host=$servername;dbname=shopmake", $username, $password);
    // set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>