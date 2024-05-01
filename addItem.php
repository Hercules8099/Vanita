<?php
    include('conn.php');

    if(isset($_POST['submit']))
    {
        // $entrynum=$_POST['entrynum'];
        $date=$_POST['date'];
        $item=$_POST['item'];

        $query="INSERT INTO items(`name`)VALUE('$item')";
        $result=mysqli_query($conn,$query);

        if($result == 1)
        {
            echo "<script>alert('ઉમેરાઈ ગયું છે.');</script>";
        }
        else{
			echo "<script>alert('ઉમેરાયું નથી !!!');</script>";
        }
        echo "<script>window.location='item.php'</script>";
    }

?>