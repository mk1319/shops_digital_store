<?php 
    include('./header.php');
?>

<div class="login-form container">
    <form id="form">
        <h2 class="text-center">Log in</h2>       
        <p class="text-center" style="color:red" id="message"></p>
        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" id="loginbtn" value="Log in" />
        </div>        
    </form>
    <p class="text-center"><a href="./register.php">Create an Account</a></p>
</div>

    <script>
        $(function(){
        
            $('#form').on('submit', function(event){
                event.preventDefault();
                let email=$('#email').val()
                let password=$('#password').val()


                $.post("./api/login.php",$('#form').serialize() ,function( data ) {
                    
                    let result=$.parseJSON(data);
                    $('#message').html(result.meg)
                    if(result.result)
                    { 
                        setTimeout(()=>{
                            $(location).attr('href','./Dashbord/index.php');
                        },2000)  
                    }
                })
            });
        });
    </script>

</body>
</html>

