<?php
    include('conn.php');

    $date=$_POST['date'];
    $name=$_POST['name'];
    $paid=$_POST['paid'];

    $date1 = explode('-',$date);
    $date = $date1['2']."".$date1['1']."".$date1['0'];

    // echo $date."/".$name."/".$paid;

    $query="INSERT INTO paid(`date`,`name`,`paid`) VALUE('$date','$name','$paid')";
    $result=mysqli_query($conn,$query);

    if($result == 1)
    {
        echo "<script>alert('ઉમેરાઈ ગયું છે.');</script>";
    }
    else{
        echo "<script>alert('ઉમેરાયું નથી !!!');</script>";
    }
    echo "<script>window.location='income.php'</script>";
?>