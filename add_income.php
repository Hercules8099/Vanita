<?php
    include('conn.php');
    include('nav.php');

    date_default_timezone_set('Asia/Kolkata');
	$date=date("d-m-Y");

    $id=$_POST['name'];
    $query="SELECT * from sales WHERE `id` = '$id' ";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result);

    $name=$row['name'];

    $name="SELECT * FROM sales WHERE `name`='$name'";
    $name_res=mysqli_query($conn,$name);

    // $name=$row['name'];

    $paid="SELECT * FROM paid WHERE `name`='$row[name]'";
    $res=mysqli_query($conn,$paid);
    $count=mysqli_num_rows($res);
    $paid=0;
    // if($count = 0){
        foreach($res as $r)
        {
            // if(isset($r['paid']))
            // {
                $paid=$paid+$r['paid'];
            // }
        }
    // }
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
            <form action="income_process.php" method="post">
                <?PHP
                    $total=0; 
                    foreach($name_res as $row1)
                    {   
                        $rate=$row1['weight']*$row1['rate']+$row1['comi']+$row1['labor'];
                        $total = $total + $rate;
                    }
                    // echo $qty."<br>";
                    // echo $total;
                ?>
                <div class="input-gr">
                <div class="col">
                    <label>તારીખ :</label>
                    <input class="input1 center" type="text" name="date" value="<?php echo $date;?>">
                </div>
                <div class="col">
                    <label>બાકી રકમ :</label>
                    <input class="input1 center" type="text" name="remaining" value="<?php echo $total-$paid;?>" readonly>
                </div>
                </div>
                <div class="col-100">
                    <label>નામ :</label>
                    <input class="input1 center" type="text" name="name" value="<?php echo $row['name'];?>" readonly>
                </div>
                <div class="col-100">
                    <label>રૂપિયા :</label>
                    <input class="input3 center" type="text" name="paid" required>
                </div>
                    <input class="form-btn" type="submit" name="submit" value="સાચવો">
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