<?php
    include('nav.php');
    include('conn.php');

    date_default_timezone_set('Asia/Kolkata');
	// $date=date("d-m-Y");
    $date=$_GET['dt'];

    $query="SELECT * FROM sales";
    $result=mysqli_query($conn,$query);
    $rows=mysqli_num_rows($result);

    $name="SELECT DISTINCT `name` FROM sales";
    $name_res=mysqli_query($conn,$name);

    $id=$_GET['id'];

    // echo $id;

    $item="SELECT * FROM purchase WHERE `id`='$id'";
    $re=mysqli_query($conn,$item);
    $rs=mysqli_fetch_array($re);

    $querysale="SELECT * FROM sales WHERE `date`='$_GET[dt]' and `item`=".$rs['item'];
    $resultsale=mysqli_query($conn,$querysale);

    // echo $rs['qty'];

    $query1="SELECT * FROM items WHERE `id`='$rs[item]'";
    $result1=mysqli_query($conn,$query1);
    $r=mysqli_fetch_array($result1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <title>વેચાણ</title>
</head>
<body>
    <div class="container">
    <input class="back-btn" type="button" name="back" onclick="back('<?php echo $date; ?>')" value="back">
    <!-- <input class="back-btn" type="button" name="back" onclick="back()" value="back"> -->
        <div class="wrapper2">
            <h2 class="form-title">વેચાણ</h2>
            <form action="addSales.php" method="post">
                <div class="input-gr">
                    <div class="col2">
                        <label>આઇટમ નામ :</label>
                        <input class="input2 center" type="text" name="item" value="<?php echo $r['name']?>" readonly>
                        <input class="input2" type="hidden" name="item1" value="<?php echo $r['id']?>" readonly>
                        <input class="input2" type="hidden" name="item2" value="<?php echo $_GET['id']?>" readonly>
                    </div>
                    <div class="col0">
                        <center><label>નામ :</label></center>
                        <input type="search" class="input3 center" name="name" list="mylist">
                            <datalist id="mylist">
                                <?php
                                foreach ($name_res as $row) {
                                    // echo $row['name'];
                                ?>
                                <option value="<?php echo $row['name'];?>">
                                <?php
                                    // echo "";
                                }
                                ?>
                            </datalist>
                    </div>
                    <div class="col2">
                        <label>તારીખ :</label>
                        <input class="input2 center" type="text" name="date" value="<?php echo $_GET['dt']; ?>" readonly>
                    </div>
                    <div class="col2">
                        <center><label>કુલ દાગીના :</label></center>
                        <input class="input3 center" type="text" name="totalqty" value="<?php echo $rs['qty']; ?>" readonly>
                    </div>
                    <!-- <div>
                        <label>નામ :</label>
                        <input class="input2" type="text" name="name" value="ફરોસ" readonly>
                    </div> -->
                </div>
                
                <div class="input-gr">
                    
                    <div class="col2">
                        <center><label>દાગીના :</label></center>
                        <input class="input3 center" type="text" name="qty" id="qty" required>
                    </div>
                    <div class="col2">
                        <center><label>વજન :</label></center>
                        <input class="input3 center" type="text" name="weight" id="weight" required>
                    </div>
                    <div class="col2">
                        <center><label>ભાવ :</label></center>
                        <input class="input3 center" type="text" name="rate" id="rate" required>
                    </div>
                    <div class="col2">
                        <center><label>કમીશન :</label></center>
                        <input class="input3 center" type="text" name="comi" id="com">
                    </div>
                    <div class="col2">
                        <center><label>મજૂરી :</label></center>
                        <input class="input3 center" type="text" name="labor" id="lab">
                    </div>
                    <div class="col2">
                        <input class="form-btn2 add" type="submit" name="add" value="ઉમેરો">
                    </div>
                </div>
            </form>
            <div class="view-sec">
                <table class="view-table">
                    <thead>
                        <tr class="t-row">
                            <th class="t-head">તારીખ</th>
                            <th class="t-head">પાર્ટી નામ</th>
                            <th class="t-head">દાગીના</th>
                            <th class="t-head">વજન</th>
                            <th class="t-head">ભાવ</th>
                            <th class="t-head">રકમ</th>
                            <th class="t-head">કમિશન</th>
                            <th class="t-head">મજૂરી</th>
                            <th class="t-head" style="width:15%;">એક્શન</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tqty=0;
                            $total=0;
                            foreach($resultsale as $row)
                            {
                                // $q="SELECT `name` FROM item WHERE `id`=".$row['item'];
                                // $r=mysqli_query($conn,$q);
                                // $item=mysqli_fetch_array($r);

                                // $s="SELECT * FROM sales WHERE `item`=".$row[''];
                                // $r=mysqli_query($conn,$q);
                                // $item=mysqli_fetch_array($r);
                        ?>
                        <tr class="t-row">
                            <td class="t-col"><?php echo $row['date'];?></td>
                            <td class="t-col"><?php echo $row['name'];?></td>
                            <td class="t-col"><?php echo $row['qty'];$tqty=$tqty+$row['qty'];?></td>
                            <td class="t-col"><?php echo $row['weight'];?></td>
                            <td class="t-col"><?php echo $row['rate'];?></td>
                            <td class="t-col"><?php echo $row['weight']*$row['rate']+$row['comi']+$row['labor'];?></td>
                            <td class="t-col"><?php echo $row['comi'];?></td>
                            <td class="t-col"><?php echo $row['labor'];?></td>
                            <td class="t-col">
                                <input class="form-btn3 delete" type="button" onclick="deletep(<?php echo $row['id']?>,<?php echo $_GET['id']?>,'<?php echo $_GET['dt']?>')" name="delete" value="નિકાડો">
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="t-row">
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                            <th class="t-head"><?php echo $tqty;?></th>
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>    
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>

    function deletep(id,sid,date)
    {
        // console.log("delete"+id);
        window.location="deleteSales.php?id="+id+"&sid="+sid+"&dt="+date;
    }
    $('#rate').change(function () {
        comi();
    });
    function comi()
    {
        var w=document.getElementById('weight').value;
        var qty=document.getElementById('qty').value;
        var rate=document.getElementById('rate').value;
        console.log(rate);
        // var weight=document.getElementsByName('weight').val;

        var c = rate*w;
        var co = (c/100)*7;
        // var co = c*qty;

        var l=qty*4;

        console.log(Math.round(co));
        document.getElementById('com').value=Math.round(co);
        document.getElementById('lab').value=Math.round(l);
    }
    // function change()
    // {
    //     window.location
    // }
    function back(date)
    {
        window.location="index.php?dt="+date;
    }

</script>
</html>