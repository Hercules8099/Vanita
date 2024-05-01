<?php
    include('conn.php');

    if(isset($_POST['add']))
    {
        $item1=$_POST['item1'];
        $item2=$_POST['item2'];

        // echo $item2;

        $date=$_POST['date'];
        $name=$_POST['name'];
        $qty=$_POST['qty'];
        $weight=$_POST['weight'];
        $rate=$_POST['rate'];
        $comi=$_POST['comi'];
        $labour=$_POST['labor'];

        $q="SELECT * FROM purchase WHERE `id`='$item2'";
        $r=mysqli_query($conn,$q);
        $p=mysqli_fetch_array($r);
        // echo $entrynum." ".$date." ".$name." ".$item." ".$qty;
        // $newqty=$p['qty']-$qty;

        // echo $newqty;

        // $query="INSERT INTO purchase(`entrynum`,`date`,`name`,`item`,`qty`)VALUE('$entrynum','$date','$name','$item','$qty')";
        // $query="UPDATE purchase SET `qty`='$newqty' WHERE `id`='$item2'";
        // $result=mysqli_query($conn,$query);
        $check="SELECT * FROM sales WHERE `date`='$date' and `name`='$name' and `qty`='$qty' and `weight`='$weight' and `rate`='$rate' and `comi`='$comi' and `labor`='$labour'";
        $res=mysqli_query($conn,$check);
        $nor = mysqli_num_rows($res);

        if($nor>0)
        {
            // exit();
            echo "<script>window.location='sales.php?id=".$item2."&dt=".$date."'</script>";
        }
        else{
            $query1="INSERT INTO sales(`item`,`date`,`name`,`qty`,`weight`,`rate`,`comi`,`labor`)VALUE('$item1','$date','$name','$qty','$weight','$rate','$comi','$labour')";
            $result1=mysqli_query($conn,$query1);

            if($result1 == 1)
            {
                echo "<script>alert('ઉમેરાઈ ગયું છે.');</script>";
            }
            else{
                echo "<script>alert('ઉમેરાયું નથી !!!');</script>";
            }
        }
        echo "<script>window.location='sales.php?id=".$item2."&dt=".$date."'</script>";
    }
?>