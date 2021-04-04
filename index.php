<!DOCTYPE html>
<html lang="en">

  <?php include('./header.php');?>

    <div class="container">
      <h1 class="headerh1">Here is List of Shop</h1>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Search</span>
      </div>
      <input type="text" id="search" class="form-control" placeholder="Search shop by name,city state" >
    </div>
      <hr/>
    </div>


<div class="container">
    <div id="product"></div>
  </div>
</div>




<script>
    $(document).ready(function(){
      $("#product").load('./api/shoplist.php',{"fetchshop":true});
  });

  $('#search').on('change keyup paste',(e)=>{
      console.log(e.target.value,"asd")
      $("#product").load('./api/shoplist.php',{"fetchshop":true,'query':e.target.value,'isquery':true});
  })

</script>

</body>
</html>