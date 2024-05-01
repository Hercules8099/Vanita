<?php
include('conn.php');
include('nav.php');
    $name="SELECT DISTINCT `name` FROM sales";
    $name_res=mysqli_query($conn,$name);
    // $row = mysqli_fetch_array($name_res);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>મડેલ રૂપિયા</title>
</head>
<body>
    <div class="container">
    <input class="back-btn" type="button" name="back" onclick="back()" value="back"></input>
        <div class="wrapper">
            <h1 class="form-title">મડેલ રૂપિયા</h1>
            <form action="add_income.php" method="post">
                    <select class="input" name="name">
                    <?php
                        foreach ($name_res as $row) {
                            $name=$row['name'];
                            $query1="SELECT * from sales where `name`='$name'";
                            $result1=mysqli_query($conn,$query1);
                            $row1=mysqli_fetch_array($result1);
                            
                            echo "<option value=" . $row1['id'] . ">" . $row['name'] . "</option>";
                        }
                    ?>
                    </select>
                    <input class="form-btn" type="submit" name="submit" value="આગડ">
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