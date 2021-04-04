<?php
include('../connection.php');
if(isset($_POST['id']))
{
    $statement = $connect->prepare("select * from shop where id='{$_POST['id']}'");
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    $output='';

    if($total_row > 0)
    {
        foreach($result as $row)
        {
            $output.="
            <div class=\"carousel\" data-ride=\"carousel\" style=\"padding-top:5px;\">
  <div class=\"carousel-inner\">
    <div class=\"carousel-item active\">
        <img width=\"100%\" height=\"400px\" src=\"{$row['image']}\">
    </div>
  </div>
</div>

    <div>
        <h3>Shop Name:-{$row['name']}</h3>
        <p>Shop Type:-{$row['type']}</p>
        <label>Address:-{$row['address']} {$row['city']} {$row['state']}</label>
        <br/>
        <label>Discription :- {$row['discription']} </label>
    </div>

<hr/>

            
            ";

        }
    }
    else{

    }

    echo $output;
}
?>
