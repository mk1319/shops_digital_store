<?php 
include('./header.php');
?>
<div class="dashboardform container ">
    <div class="login-form" style="flex:2; margin-right:10px">
        <form id="form">
            <h2 class="text-center" id="titleheading">Create Store</h2>
            <p class="text-center" style="color:red" id="message"></p>
            <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="shop Name" required="required">
            </div>
            <div class="form-group">
                <input type="text" name="type" id="type" class="form-control" placeholder="shop Type eg:- Cake Shop" required="required">
            </div>
            <div class="form-group">
                <textarea name="discription" id="discription" class="form-control" placeholder="Shop Discription" required="required">
                </textarea>
            </div>
            <div class="form-group">
                <input type="text" name="city" id="city" class="form-control" placeholder="City" required="required">
            </div>
            <div class="form-group">
                <input type="text" name="state" id="state" class="form-control" placeholder="State" required="required">
            </div>
            <div class="form-group">
                <input type="text" name="address" id="address" class="form-control" placeholder="Address" required="required">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" id="submit" value="Register" />
            </div>
        </form>
    </div>

    <div style="flex:2" class="imagecontainer">
        <img src="" id="shopimage" width="100%" height="250px" />
        <hr />
        <form enctype="multipart/form-data" id="imageform">
            <h3 class="text-center">Select image to upload:</h3>
            <p class="text-center" id="imagemes" style="color:red"></p>
            <input class="btn btn-block" type="file" name="image" id="image" required="required">
            <input class="btn btn-primary btn-block" type="submit" id="insertimage" name="insertimage" value="Upload Image" name="submit">
        </form>
    </div>
</div>

<div class="container login-form">

</div>



<script>
    $(document).ready(function() {
        $("#discription").val("");
        $.post("../api/updateprofile.php", {
            'fetch': true
        }, function(data) {
            let result = $.parseJSON(data);
            if (result.length) {
                let resdata = result[0]
                $("#name").val(resdata.name);
                $("#type").val(resdata.type);
                $("#discription").val(resdata.discription);
                $("#city").val(resdata.city);
                $("#state").val(resdata.state);
                $("#address").val(resdata.address);
                $('#submit').val('Update Profile')
                $('#titleheading').html('Update Profile')
                $('#shopimage').attr('src',resdata.image)
            }
        })

    });
    $(function() {
        $('#form').on('submit', function(event) {
            event.preventDefault();
            let email = $('#email').val()
            let password = $('#password').val()

            $.post("../api/updateprofile.php", $('#form').serialize(), function(data) {

                let result = $.parseJSON(data);
                $('#message').html(result.meg)
                setTimeout(()=>{
                    location.reload(true);
                },2000)
            })
        });
    });



$(document).ready(function(){  
      $('#imageform').on('submit',function(e){
          e.preventDefault();
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                $('#imagemes').html('select file!') 
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                    $('#imagemes').html('Inavlid File') 
                     $('#image').val('');  
                     return false;  
                }

        const file = document.getElementById('image').files[0];
        const formData = new FormData();
        formData.append('file', file);
        formData.append('upload_preset', 'FirstReactApp');
        formData.append("cloud_name", "dwnxodft3");

            fetch("http://api.cloudinary.com/v1_1/dwnxodft3/image/upload", {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then((data) => {

                if (data.secure_url !== '') {
                    const uploadedFileUrl = data.secure_url;
                    
                    $.post("../api/updateprofile.php",{'url':data.url,'uploadimage':true}, function(d) {
                        let result = $.parseJSON(d);
                        $('#imagemes').html(result.meg)
                        $('#image').val('');  
                        $('#shopimage').attr('src',data.url)
                        setTimeout(()=>{
                            $('#imagemes').html("")
                            location.reload(true);
                        },2000)
                    })
                }
            })
            .catch(err => $('#imagemes').html("Try After sometime!"));

           }  
      });

 });  



   
    
</script>

</body>

</html>