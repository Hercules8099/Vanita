<?php
    include('conn.php');

    if(isset($_POST['add']))
    {
        // $entrynum=$_POST['enrtynum'];
        $date=$_POST['date'];
        $name=$_POST['name'];
        $item=$_POST['item'];
        $qty=$_POST['qty'];

        $q="SELECT * FROM purchase WHERE `item`='$item' and `date`='$date'";
        $r=mysqli_query($conn,$q);
        // $p=mysqli_fetch_array($r);
        $nr=mysqli_num_rows($r);

        if($nr>=1)
        {
            $query="UPDATE purchase SET `qty`='$qty' WHERE `item`='$item' and `date`='$date'";
        }
        else{
            $query="INSERT INTO purchase(`date`,`name`,`item`,`qty`)VALUE('$date','$name','$item','$qty')";
        }
        // $newqty=$p['qty']+$qty;
        // echo $item;
        // echo $entrynum." ".$date." ".$name." ".$item." ".$qty;


        $result=mysqli_query($conn,$query);

        if($result == 1)
        {
            echo "<script>alert('ઉમેરાઈ ગયું છે.');</script>";
        }
        else{
			echo "<script>alert('ઉમેરાયું નથી !!!');</script>";
        }
        echo "<script>window.location='index.php?dt=".$date."'</script>";
    }
?>