



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Resources/student_loginpage.css?v=<?php echo time(); ?>">

        <!--fontawsome links-->
        <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
         <link rel="stylesheet"href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
        <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
        <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
        <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
        <link href="Resources/fontawesome/css/solid.css" rel="stylesheet" />
    <title>Login</title>
</head>
<body>

<div class="login_box">

<div class="form_box">

    <form action="student_login_connection.php" method="post" class=" needs-validation" >

    <h1 id="title">Login</h1>

    <div class="input_filed">
        <i class="fa-solid fa-envelope"></i>
        <input type="email" placeholder="Exaple@gmail.com " id="email" name="email" required>
    </div>
    

    <div class="input_filed">
        <i class="fa-solid fa-lock"></i>
        <input type="password" placeholder="Password" name="password" required>
    </div>

    <p>forgot password?<a href="#">click here</a></p>

    <div class="btn_filed">
        
        <button type="submit" id="sign_up_btn">login</button>

        <a href="student_registration.php" type="button" class="disable" id="sign_in_btn">Apply</a>
    
    </div>

    <footer>
        <p>&#9400 2024|Educenter|WOODS University </p>
    </footer>
</div>

    </form>

</div>


</div>


</body>
</html>