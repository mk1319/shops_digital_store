<?php
include('../connection.php');
session_start();

if(isset($_POST['fetchlist']))
{
    $statement = $connect->prepare("select * from product where id='{$_POST['id']}'");
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    $output="<div class=\"row\" style=\"justify-content: center;\">";
            
    if($total_row > 0)
    {
    
    foreach($result as $row)
    {
       $output.=
        " <div class=\"card col-sm-4 col-xl-3 col-lg-3 col-md-4\" style=\"width:100%;margin:5px\">
            <img class=\"card-img-top\" src=\"{$row['image']}\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">{$row['name']} </h5>
                <p>{$row['price']}</p>
                <p class=\"card-text\">{$row['discription']}</p>
            </div>
        </div>
        ";
    }  
    }
    else{
    }
    echo "</div>".$output;
}


if(isset($_POST['productdata']))
{

    $statement = $connect->prepare("insert into product(name,price,discription,image,id) value('{$_POST['name']}','{$_POST['price']}','{$_POST['discription']}','{$_POST['url']}','{$_SESSION['id']}') ");
    if($statement->execute())
    {
        echo json_encode(array("meg"=>"Product added"));
    }
    else
    {
        echo json_encode(array("meg"=>"Try after sometime"));
    }

}


if(isset($_POST['fetchproduct']))
{

    $statement = $connect->prepare("select * from product where id='{$_SESSION['id']}'");
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output="<div class=\"row\" style=\"justify-content: center;\">";
            
    if($total_row > 0)
    {
    foreach($result as $row)
    {
       $output.=
        " <div class=\"card col-sm-4 col-xl-3 col-lg-3 col-md-4\" style=\"width:100%;margin:5px\">
            <img class=\"card-img-top\" src=\"{$row['image']}\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">{$row['name']} </h5>
                <p>{$row['price']}</p>
                <p class=\"card-text\">{$row['discription']}</p>
            </div>
            <button class=\"btn\" onclick=\"deleteproduct({$row['productid']})\">Delete</button>
        </div>
        ";
    }  
    }
    else{
    }
    echo "</div>".$output;
}


if(isset($_POST['delete']))
{
    $statement = $connect->prepare("delete  from product where productid='{$_POST['id']}'");
    if($statement->execute())
    {
        echo json_encode(array("meg"=>"Product deleted!"));
    }
    else
    {
        echo json_encode(array("meg"=>"Try after sometime"));
    }
}


?>
