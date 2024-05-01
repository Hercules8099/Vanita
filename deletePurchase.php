<?php
    include('conn.php');

    $id=$_GET['id'];
    $date=$_GET['dt'];

    $query="DELETE FROM purchase WHERE `id`='$id'";
    $result=mysqli_query($conn,$query);

    if($result == 1)
        {
            echo "<script>alert('નિકડી ગયું છે.');</script>";
        }
        else{
			echo "<script>alert('નિકડ્યું નથી !!!');</script>";
        }
        echo "<script>window.location='index.php?dt=".$date."'</script>";
?>