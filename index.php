<?php
	
    session_start();
    include('nav.php');
    include('conn.php');
    // include('backbtn.php');
    
    $id=$_SESSION['id'];
    if($id=="")
    {
        echo "<script>window.location='login.php'</script>";
    }

    date_default_timezone_set('Asia/Kolkata');

    if(isset($_GET['dt']))
    {
        $date=$_GET['dt'];
    }
    else{
        $date=date("Y-m-d");
    }

    // $date1=explode('-',$date);
    // $date=$date1['2']."-".$date1['1']."-".$date1['0'];

    $query="SELECT * FROM purchase";
    $result=mysqli_query($conn,$query);
    $rows=mysqli_num_rows($result);

    $q="SELECT * FROM items";
    $r=mysqli_query($conn,$q);

    $query1="SELECT * FROM purchase WHERE `date`='$date'";
    $result1=mysqli_query($conn,$query1);

    // $query1="SELECT * FROM item";
    // $result1=mysqli_query($conn,$query1);
    // $row=mysqli_fetch_array($result1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ખરીદી</title>
</head>
<body>
    <div class="container">
    <input class="back-btn" type="button" name="back" onclick="back('<?php echo $date; ?>')" value="back">
        <div class="wrapper2">
            <h2 class="form-title">ખરીદી</h2>
            <form action="addPurchase.php" method="post">
                <div class="input-gr">
                    <!-- <div> -->
                        <!-- <label>એન્ટ્રી નં :</label> -->
                    
                        
                        <!-- <input class="input2 center" type="hidden" name="enrtynum" value="<?php echo $rows+1; ?>" readonly> -->
                    <!-- </div> -->
                    
                    <div>
                        <label>નામ :</label>
                        <input class="input2 center" type="text" name="name" value="ફરોસ" readonly>
                    </div>
                    <?php
                        $d1 = explode('-',$date);
                        $date1=$d1['2']."-".$d1['1']."-".$d1['0'];
                    ?>
                    <div>
                        <label>તારીખ :</label>
                        <input class="input2 center" type="text" name="date1" id="date1" value="<?php echo $date1; ?>">
                        <input class="input2 center" type="hidden" name="date" id="date" value="<?php echo $date; ?>">
                        <input type="button" onclick="change()" value="change">
                    </div>
                </div>
                
                <div class="input-gr">
                    <div class="col">
                        <center><label>આઇટમ :</label></center>
                        <select class="input3 center" name="item" id="item">
                            <optgroup label="આઇટેમ લિસ્ટ"></optgroup>
                            <!-- <option></option> -->
                            <?php
                            foreach ($r as $row1) {
                                echo "<option value=" . $row1['id'] . ">" . $row1['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col1">
                        <center><label>દાગીના :</label></center>
                        <input class="input3 center" type="text" name="qty" id="qty" placeholder="દાગીના લખો" required>
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
                            <!-- <th class="t-head">એન્ટ્રી નં</th> -->
                            <th class="t-head">આઈટમ નામ</th>
                            <th class="t-head">દાગીના</th>
                            <th class="t-head">વેચાણ</th>
                            <th class="t-head">બેલેન્સ</th>
                            <th class="t-head">ભાવ</th>
                            <th class="t-head">રકમ</th>
                            <th class="t-head">વજન</th>
                            <th class="t-head">એકશન</th>
                            <!-- <th class="t-head" style="width:15%;">એક્શન</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $subtotal=0;
                            foreach($result1 as $row)
                            {
                                // $q="SELECT `name` FROM item WHERE `id`=".$row['item'];
                                // $r=mysqli_query($conn,$q);
                                // $item=mysqli_fetch_array($r);

                                $s="SELECT * FROM items WHERE `id`=".$row['item'];
                                $r=mysqli_query($conn,$s);
                                $item=mysqli_fetch_array($r);
                                
                                $itemv=$row['item'];

                                // echo $itemv;

                                $sale="SELECT * FROM sales WHERE `item`='$itemv' and `date`='$date'";
                                $res=mysqli_query($conn,$sale);
                                // $sa=mysqli_fetch_array($res);
                                $qty1=0;
                                $rate1=0;
                                $total1=0;
                                $weight1=0;
                                foreach($res as $sa)
                                {
                                    $qty1=$qty1+$sa['qty'];
                                    $rate1=$rate1+$sa['rate'];
                                    $total1=$total1+$sa['rate']*$sa['weight']+$sa['comi']+$sa['labor'];
                                    $weight1=$weight1+$sa['weight'];
                                }
                        ?>
                        <tr class="t-row">
                            <!-- <td class="t-col" onclick="sales(<?php echo $row['item']; ?>)"><?php echo $row['entrynum'];?></td> -->
                            <td class="t-col" onclick="sales(<?php echo $row['id']; ?>,'<?php echo $date; ?>')"><?php echo $item['name']?></td>
                            <td class="t-col" onclick="sales(<?php echo $row['id']; ?>,'<?php echo $date; ?>')"><?php echo $row['qty'];?></td>
                            <td class="t-col" onclick="sales(<?php echo $row['id']; ?>,'<?php echo $date; ?>')"><?php if(isset($sa['qty'])){echo $qty1;}else{echo 0;} ?></td>
                            <td class="t-col" onclick="sales(<?php echo $row['id']; ?>,'<?php echo $date; ?>')"><?php if(isset($sa['qty'])){echo $row['qty']-$qty1;}else{echo $row['qty'];}?></td>
                            <td class="t-col" onclick="sales(<?php echo $row['id']; ?>,'<?php echo $date; ?>')"><?php if(isset($sa['rate'])){echo $rate1;}else{echo 0;}?></td>
                            <td class="t-col" onclick="sales(<?php echo $row['id']; ?>,'<?php echo $date; ?>')"><?php if(isset($sa['rate'])){echo $total1;$subtotal=$subtotal+$total1;}else{echo 0;}?></td>
                            <td class="t-col" onclick="sales(<?php echo $row['id']; ?>,'<?php echo $date; ?>')"><?php if(isset($sa['weight'])){echo $weight1;}else{echo 0;}?></td>
                            <td class="t-col">
                                <input class="form-btn3 delete" type="button" onclick="deletep(<?php echo $row['id']?>,'<?php echo $date?>');" name="delete" value="નિકાડો">
                            </td>
                            </div>
                            <!-- <td class="t-col">
                                <input class="form-btn3 edit" type="button" onclick="edit(<?php echo $row['id']?>)" name="edit" value="સુધારો">
                                <input class="form-btn3 delete" type="button" onclick="deletep(<?php echo $row['id']?>)" name="delete" value="નિકાડો">
                            </td> -->
                            <!-- $subtotal=$subtotal+$sa['total']; -->
                        </tr>
                        <?php }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="t-row">
                            <!-- <th class="t-head"></th> -->
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                            <th class="t-head"><?php echo $subtotal; ?></th>
                            <th class="t-head"></th>
                            <th class="t-head"></th>
                            <!-- <th class="t-head"></th> -->
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>    
    </div>
</body>
<script>

    function sales(id,date)
    {
        // console.log(date);
        window.location="sales.php?id="+id+"&dt="+date;
    }
    function change()
    {
        var dt=document.getElementById('date1').value;

        var d = dt.split('-');

        var dt = d[2]+'-'+d[1]+'-'+d[0];
        
        window.location="index.php?dt="+dt;
    }
    function deletep(id,date)
    {
        // console.log("delete"+id);
        window.location="deletePurchase.php?id="+id+"&dt="+date;
    }
    $('#item').change(function () {
        goqty();
    });
    function goqty()
    {
        document.getElementById('qty').focus();
    }
    function back(date)
    {
        window.location="index.php?dt="+date;
    }

</script>
</html>