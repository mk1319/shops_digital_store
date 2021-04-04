<?php include('./header.php'); ?>

<div class="login-form container">
    <form id="productform">
        <h2 class="text-center">Add Product</h2>
        <p class="text-center" style="color:red" id="message"></p>
        <div class="form-group">
            <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" required="required">
        </div>
        <div class="form-group">
            <input type="text" name="price" id="price" class="form-control" placeholder="Product Price" required="required">
        </div>
        <div class="form-group">
            <textarea name="discription" id="discription" class="form-control" placeholder="Product Discription(optional)">
            </textarea>
        </div>
        <div class="form-group">
            <input class="btn btn-block" type="file" name="image" id="image" required="required">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" id="add_product" value="Add Product" />
        </div>
    </form>
</div>

<div class="container">
    <h3 class="text-center">List of product</h3>
    <p class="text-center" style="color:red" id="meg"></p>
    <div id="productlist"></div>
</div>


<script>
    function deleteproduct(id) {
        $.post("../api/product.php",{'id':id,'delete':true}, function(data) {
            let result = $.parseJSON(data);
            $('#meg').html(result.meg)

            setTimeout(() => {
                location.reload(true);
            }, 2000)
        })
    }



    $(document).ready(function() {
        $("#discription").val("");
        $('#productlist').load('../api/product.php', {
            'fetchproduct': true
        });
    })


    $(document).ready(function() {
        $('#productform').on('submit', function(e) {
            e.preventDefault();
            var image_name = $('#image').val();
            if (image_name == '') {
                $('#message').html('select image file!')
                return false;
            } else {
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    $('#message').html('Inavlid File')
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
                            let name = $('#name').val();
                            let price = $('#price').val();
                            let discription = $('#discription').val();

                            $.post("../api/product.php", {
                                'url': data.url,
                                'productdata': true,
                                'name': name,
                                'price': price,
                                'discription': discription
                            }, function(d) {
                                let result = $.parseJSON(d);
                                $('#message').html(result.meg)
                                $('#image').val('');

                                setTimeout(() => {
                                    $('#message').html("")
                                    $('#name').val("");
                                    $('#price').val("");
                                    $('#discription').val("");
                                    location.reload(true);
                                }, 2000)

                            })
                        }
                    })
                    .catch(err => $('#message').html("Try After sometime!"));
            }
        });

    });
</script>