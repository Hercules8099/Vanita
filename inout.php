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
<style>
    .wrapper{
        margin: 5% auto;
    }
</style>
<body>
    <div class="container">
    <input class="back-btn" type="button" name="back" onclick="back()" value="back"></input>
        <div class="wrapper">
            <h1 class="form-title">રૂપિયા</h1>
            <form action="add_inout.php" method="post">
                <div class="col-100">
                    <label>નામ :</label>
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
                </div><br>
                <div class="input-gr">
                <div class="col-30">
                    <label>તારીખ થી:</label>
                    <!-- <input class="input1 center" type="text" name="date" value="<?php echo $date;?>" readonly> -->
                    <input class="input" type="date" name="fromdate" required>
                </div><br>
                <div class="col-30">
                    <label>તારીખ સુધી:</label>
                    <!-- <input class="input1 center" type="text" name="date" value="<?php echo $date;?>" readonly> -->
                    <input class="input" type="date" name="todate" required>
                </div>    <br>
                </div>
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