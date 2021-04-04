<?php
include('../connection.php');
session_start();

if(isset($_POST['email']))
{
    $statement = $connect->prepare("select * from register where email='{$_POST['email']}'");
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    if($total_row > 0)
    {
        foreach($result as $row)
        {
            if($row['password']==$_POST['password'])
            {
                $_SESSION['loginstatus']=true;
                $_SESSION['id']=$row['id'];

                $statement = $connect->prepare("select * from shop where id='{$row['id']}'");
                $statement->execute();
                $total_row = $statement->rowCount();
                if($total_row > 0)
                {
                    $_SESSION['hasshop']=true;
                }
                
                echo json_encode(array("meg"=>"Login Sucessful", "result"=>true));
            }
            else
            {          
                echo json_encode(array("meg"=>"Paswword not match", "result"=>false));
            }
        }
    }
    else{
            echo json_encode(array("meg"=>"email not register", "result"=>false));
    }
}
?>