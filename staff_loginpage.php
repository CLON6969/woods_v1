<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


           
           


    <link rel="stylesheet" href="Resources/staff_loginpage.css?v=<?php echo time(); ?>">

        <!--fontawsome links-->
        <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
         <link rel="stylesheet"href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
        <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
        <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
        <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
        <link href="Resources/fontawesome/css/solid.css" rel="stylesheet" />
    <title>Staff login</title>
</head>
<body>

<div class="login_box">

<div class="form_box">
    <form action="staff_login_connection.php" method="post" class=" needs-validation" >
    <h1 id="title">Login <i class="fas fa-lock"></i></h1>

    <div class="input_filed">
        <i class="fa-solid fa-envelope"></i>
        <input type="email"  name="email"  placeholder="Exaple@gmail.com " required>
    </div>
    

    <div class="input_filed">
        <i class="fa-solid fa-lock"></i>
        <input type="password" placeholder="password" name="password" required>
    </div>

   

<div class="remember"> 
        <input type="checkbox" class="remember_input">
        <p>Remember Me</p>
</div>




    
    <div class="btn_filed">
        
        <button type="submit" id="sign_up_btn">login</button>
    
    </div>


    <p class="forgot-password">forgot password??<a href="#">click here</a></p>


    <footer>
        <p>&#9400 2024|Educenter|WOODS University </p>
    </footer>
</div>
    </form>
</div>


</div>


</body>
</html>