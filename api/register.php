<?php
include('../connection.php');
session_start();

if($_POST['email'])
{
    $statement = $connect->prepare("select * from register where email='{$_POST['email']}'");
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    if($total_row > 0)
    {   
        echo json_encode(array("meg"=>"Email Register!", "result"=>false));
    }
    else
    {

    $statement = $connect->prepare("insert into register(name,email,password) value('{$_POST['name']}','{$_POST['email']}','{$_POST['password']}')");
    if($statement->execute())
    {
       $_SESSION['id']=$connect->lastInsertId();
       $_SESSION['loginstatus']=true;
       echo json_encode(array("meg"=>"account Created", "result"=>true));
    }
    else{
        echo json_encode(array("meg"=>"Please Try After Sometime", "result"=>false));
    }
        
    }
}
?>