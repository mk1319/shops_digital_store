<?php
include_once('../connection.php');

if(isset($_POST['fetchshop']))
{   
    $query='';
    if(isset($_POST['isquery']))
    {   
        if($_POST['query']!='')
        {
            $query="select * from shop where city LIKE '%{$_POST['query']}%' or state LIKE '%{$_POST['query']}%' 
                or name LIKE '%{$_POST['query']}%' or type LIKE '%{$_POST['query']}%' 
            ";
        }
        else{
        $query='select * from shop';

        }

    }
    else
    {
        $query='select * from shop';
    }

    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output="<div class=\"row\" style=\"justify-content: center;\">";
    if(isset($_POST['isquery']))
    {
        if($_POST['query']!='')
        {
            $output.="<h4 class=\"col-sm-12 col-xl-12 col-lg-12 col-md-12 text-center \">{$total_row} Shop Found</h4>";
        }
    }

 
 
 if($total_row > 0)
 {
     foreach($result as $row)
     {
         $output.=
         " <div class=\"card col-sm-4 col-xl-3 col-lg-3 col-md-4\" style=\"width:100%;margin:5px\">
         <a href='./shopdetail.php?id={$row['id']}' style=\"color:black;text-decoration: none;\">
            <img class=\"card-img-top\" src=\"{$row['image']}\" width=\"100%\">
            <div class=\"card-body\">
            <h5 class=\"card-title\">{$row['name']} </h5>
            <p>Shop Type:- {$row['type']}</p>
            <p class=\"card-text\">{$row['discription']}</p>
            </div>
            </a>
            </div>
            ";
        }
    }
    else{}
    
    echo "</div>".$output;
    
}

?>