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
        <h2>Log in to Twitter</h2>
        <form action="login_check.php" method="POST">
            <div class="entry">
                <input id="focus" type="email" name="login_mail" placeholder="email">
                <input type="password" name="login_pass" placeholder="password">
            </div>
            <div class="button">
                <input type="submit" value="Log in">
            </div>
        </form>
        <a href="signup.php">Sign up for Twitter</a>
    </div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$("#focus").focus();
</script>
</body>
</html>