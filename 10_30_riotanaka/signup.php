<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/signup_login.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
    <div class="signup-form">
        <i class="fab fa-twitter"></i>
        <h2>Join Tiwtter Today.</h2>
        <form action="register.php" method="POST">
            <div class="entry">
                <input id="focus" type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="text" name="username" placeholder="Username">
                <input type="hidden" name="name" value="アカウント名">    
            </div>
            <div class="button">
                <input type="submit" value="Sign up">
            </div>
        </form>
        <a href="login.php">Already have an account?</a>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$("#focus").focus();
</script>
</body>
</html>