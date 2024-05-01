<?php
    include('conn.php');
    include('nav.php');

    date_default_timezone_set('Asia/Kolkata');
	$date=date("d-m-Y");

    $query="SELECT * FROM purchase";
    $result=mysqli_query($conn,$query);
    $rows=mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/index.css"> -->
    <title>આઇટમ</title>
</head>
<body>
<div class="container">
<input class="back-btn" type="button" name="back" onclick="back()" value="back"></input>
        <div class="wrapper">
            <h1 class="form-title">આઇટમ</h1>
            <form action="addItem.php" method="post">
                    <!-- <input class="input" type="text" readonly name="entrynum" value="<?php echo $rows+1;?>"> -->
                    <input class="input" type="text" readonly name="date" value="<?php echo $date;?>">
                    <input class="input" type="text" name="item" placeholder="એન્ટર આઇટમ નેમ">
                    <!-- <input class="input" type="text" name="username" placeholder="Enter User Name"> -->

                    <input class="form-btn" type="submit" name="submit" value="ઉમેરો">
                    <!-- <br><br> -->
                    <!-- <span>Don't Have An Account? Click To <a href="signup.php">Sign Up</a></span> -->
            </form>
        </div>    
    </div>
</body>
<script>
    function back()
    {
        window.location="index.php";
    }
</script>
</html>