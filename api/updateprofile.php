<?php
include('../connection.php');
session_start();

if(isset($_POST['fetch']))
{
    $statement = $connect->prepare("select * from shop where id='{$_SESSION['id']}'");
    $statement->execute();
    $total_row = $statement->rowCount();
    if($total_row > 0)
    {   
        $result = $statement->fetchAll();
        echo json_encode($result);
    }
    else
    {  
        echo json_encode(array());
    }
}
else{
if(isset($_POST['name']))
{
    $statement = $connect->prepare("select * from shop where id='{$_SESSION['id']}'");
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    if($total_row > 0)
    {   
        $statement = $connect->prepare("update shop set name='{$_POST['name']}',city='{$_POST['city']}',
        state='{$_POST['state']}',type='{$_POST['type']}',discription='{$_POST['discription']}',address='{$_POST['address']}' where id='{$_SESSION['id']}'");
        if($statement->execute())
        {
            echo json_encode(array("meg"=>"Data Updated"));
        }
        else{
            echo json_encode(array("meg"=>"Please Try After Sometime!"));
        }
    }
    else
    {

    $statement = $connect->prepare("insert into shop(name,city,state,type,discription,address,id) 
    value('{$_POST['name']}','{$_POST['city']}','{$_POST['state']}','{$_POST['type']}','{$_POST['discription']}','{$_POST['address']}','{$_SESSION['id']}')");
    if($statement->execute())
    {
       $_SESSION['hasshop']=true;
       echo json_encode(array("meg"=>"Shop Created now you can add product."));
    }
    else{
        echo json_encode(array("meg"=>"Please try after sometime."));
    }
    }
}
}

if(isset($_POST['uploadimage']))
{
    $statement = $connect->prepare("select * from shop where id='{$_SESSION['id']}'");
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    if($total_row > 0)
    {   
        $statement = $connect->prepare("update shop set image='{$_POST['url']}' where id='{$_SESSION['id']}'");
        if($statement->execute())
        {
            echo json_encode(array("meg"=>"Image Updated"));
        }
        else{
            echo json_encode(array("meg"=>"error duriing process!"));
        }
    }
    else
    {

    $statement = $connect->prepare("insert into shop(image,id) 
    value('{$_POST['url']}','{$_SESSION['id']}')");
    if($statement->execute())
    {
       $_SESSION['hasshop']=true;
       echo json_encode(array("meg"=>"Image Uploaded"));
    }
    else{
        echo json_encode(array("meg"=>"Please try after sometime."));
    }
    }
}

?>