<?php
    include('conn.php');

    $id=$_GET['id'];
    $sid=$_GET['sid'];
    $date=$_GET['dt'];

    $query="DELETE FROM sales WHERE `id`='$id'";
    $result=mysqli_query($conn,$query);

    if($result == 1)
        {
            echo "<script>alert('નિકડી ગયું છે.');</script>";
        }
        else{
			echo "<script>alert('નિકડ્યું નથી !!!');</script>";
        }
        echo "<script>window.location='sales.php?id=".$sid."&dt=".$date."'</script>";
?>