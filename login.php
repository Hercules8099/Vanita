<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>લૉગિન</title>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <h1 class="form-title">લૉગિન</h1>
            <form action="login_process.php" method="post">
                    <input class="input" type="text" name="username" placeholder="એન્ટર યુઝર નેમ">
                    <input class="input" type="password" name="pass" placeholder="એન્ટર પાસવર્ડ">
                    <!-- <input class="input" type="text" name="username" placeholder="Enter User Name"> -->

                    <input class="form-btn" type="submit" name="submit" value="લૉગિન">
                    <!-- <br><br> -->
                    <!-- <span>Don't Have An Account? Click To <a href="signup.php">Sign Up</a></span> -->
            </form>
        </div>    
    </div>
</body>
</html>