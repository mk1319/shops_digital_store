<?php include('./header.php');?>



<div id="shop" class="container" style="padding:0px;">
    
</div>

<div class="container">
    <h2 class="text-center">List of product</h2>
    <div id="productlist" ></div>
</div>




<script>


 $(document).ready(function(){
    let searchParams = new URLSearchParams(window.location.search)
    if(searchParams.has('id'))
    {
        if(jQuery.type(parseInt(searchParams.get('id'))) === "number")
        {
            let id=parseInt(searchParams.get('id'))
            if(!isNaN(parseInt(searchParams.get('id'))))
            {
                $("#shop").load('./api/shopdetail.php',{'id':id});
            
                $("#productlist").load('./api/product.php',{'id':id,'fetchlist':true})
            
            }
            else
            {
                $('#shop').html('<h1 class="text-center" style="margin-top:10px">No Shop Data Found</h1>')
            }
        }

    }
    else
    {
        $('#shop').html('<h1 class="text-center" style="margin-top:10px">No Shop Data Found</h1>')
    }
});

</script>

</body>
</html>