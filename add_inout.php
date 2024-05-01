<head>
<style type="text/css">
    /* div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
        height: 100%;
    } */

    table {
        height: auto;
        width: auto;
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
    }

    table td, table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    table tr:nth-child(even){background-color: #f2f2f2;}

    table tr{background-color: #ddd;}

    table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color:#001f3f;
        color: white;
    }

    .main-table {
        background: white;
        /*margin: 10px;*/
        padding: 0 30px;
    }


    .viewbtn
  {
    font-size: 24px;
    color: black;
    padding: 5px;
  }
.editbtn
{
  font-size: 24px;
  color: black;
  padding: 5px;
}
.deletebtn
{
  font-size: 24px;
  color: black;
  padding: 5px;
}
.viewbtn:hover
{
  color: darkblue;
}
.editbtn:hover
{
  color: green;
}
.deletebtn:hover
{
  color: red;
}
.back-btn
{
    position: absolute;
    height: auto;
    width: auto;
    color: rgb(125, 0, 0);
    top:1px;
    z-index: 1000;
    margin: 0px 10px;
    padding: 10px;
    border-radius: 10px;

}

.main-row{
    display: flex;
    flex-direction: row;
    width: 100%;
}
.rem-amt
{
    width: 100%;
    text-align: center;
    /* height: 40px; */
    /* background-color: gray; */
    /* font-style: bold; */
}

</style>
<link href="img/Fav_Icon.png" rel="icon">
<link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<?php
require_once('conn.php');

$name="SELECT * FROM sales WHERE `id`='$_POST[name]'";
$name_re=mysqli_query($conn,$name);
$name_row=mysqli_fetch_array($name_re);

// echo $name_row['name'];

$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];

// $time  = strtotime($fromdate);
// $day   = date('d',$time);
// $month = date('m',$time);
// $year  = date('Y',$time);

// $time1  = strtotime($todate);
// $day1   = date('d',$time1);
// $month1 = date('m',$time1);
// $year1  = date('Y',$time1);

// $fromdate=$day."-".$month."-".$year;
// $todate=$day1."-".$month1."-".$year1;

// echo $fromdate."<br>";
// echo $todate;


$query = "SELECT * FROM sales where `name`='$name_row[name]' and `date`>='$fromdate' and `date`<='$todate' group by `date`";
$result = mysqli_query($conn, $query);

$query1 = "SELECT * FROM paid where `name`='$name_row[name]' and `date`>='$fromdate' and `date`<='$todate' group by `date`";
$result1= mysqli_query($conn, $query1);
// $row1 = mysqli_fetch_array($result1);

// $row1 = mysqli_fetch_array($result);
// include('sidebar2.php');
?>
<h2 class="rem-amt" id="amt"></h2>
<input class="back-btn" type="button" name="back" onclick="back()" value="back"></input>
<div class="main-row">
<div class="main-table" style="overflow-x:auto;width:100%;">
    <h2>ઉધાર વિગત</h2>
    <hr>
    <table id="example" class="table display nowrap" style="width: 100%;margin-top:10px;">
        <thead>
            <tr class="tr">
                <th>તારીખ</th>
                <th>નામ</th>
                <th>રકમ ઉધાર</th>
                <!-- <th>રકમ જમા</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $date=0;
            $rate=0;
            $totalr=0;
            foreach ($result as $row) {

                $q="SELECT * FROM sales WHERE `date`='$row[date]' and `name`='$row[name]'";
                $r=mysqli_query($conn,$q);

                // $ro=mysqli_fetch_array($r);
                foreach($r as $ro)
                {
                    if($date != $ro['date'])
                    {
                        $date=$ro['date'];
                        $rate=$ro['rate']*$ro['weight']+$ro['comi']+$ro['labor'];
                    }
                    else{
                        $rate=$rate+$ro['rate']*$ro['weight']+$ro['comi']+$ro['labor'];
                    }
            }
                $totalr=$totalr+$rate;
            ?>
                <tr>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $rate; ?></td>
                    <!-- <td><?php if($row['date']==$ro1['date']){echo $paid;}else{echo 0;} ?></td> -->
                </tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="tr">
                <th></th>
                <th></th>
                <th><?php echo $totalr; ?><input type="hidden" value="<?php echo $totalr; ?>" id="ratet"></th>
                <!-- <th></th> -->
            </tr>
        </tfoot>
    </table>
    
</div>
<!-- //////////////////////////////////////////////////////////////////////// -->
<div class="main-table" style="overflow-x:auto;width:100%;">
    <h2>જમા વિગત</h2>
    <hr>
    <table id="example1" class="table display nowrap" style="width: 100%;margin-top:10px;">
        <thead>
            <tr class="tr">
                <th>તારીખ</th>
                <th>નામ</th>
                <!-- <th>રકમ ઉધાર</th> -->
                <th>રકમ જમા</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $date1=0;
            $paid=0;
            $totalp=0;
            foreach ($result1 as $row1) {

                $q1="SELECT * FROM paid WHERE `date`='$row1[date]' and `name`='$row1[name]'";
                $r1=mysqli_query($conn,$q1);

                // $ro=mysqli_fetch_array($r);
                foreach($r1 as $ro1)
                {
                    if($date1 != $ro1['date'])
                    {
                        $date1=$ro1['date'];
                        $paid=$ro1['paid'];
                    }
                    else{
                        $paid=$paid+$ro1['paid'];
                    }
            }
                $totalp=$totalp+$paid;
            ?>
                <tr>
                    <td><?php echo $row1['date']; ?></td>
                    <td><?php echo $row1['name']; ?></td>
                    <td><?php echo $paid; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="tr">
                <th></th>
                <th></th>
                <th><?php echo $totalp; ?><input type="hidden" value="<?php echo $totalp; ?>" id="paidt"></th>
                <!-- <th></th> -->
            </tr>
        </tfoot>
    </table>
    
</div>
<!-- <h2 class="rem-amt"><strong>કુલ બાકી :</strong><?php echo $totalr+$totalp;?></h2> -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function(){
      $('#example').DataTable({
          scrollX:true
      });  
 });
 $(document).ready(function(){
      $('#example1').DataTable({
          scrollX:true
      });  
 });
 $(document).ready(function(){
    let rate = document.getElementById('ratet').value;
    let paid = document.getElementById('paidt').value;

    let t = Number(rate)-Number(paid);

    console.log(t);

    document.getElementById('amt').textContent="કુલ બાકી : " + t;
 });
</script>
<script>
    function back()
    {
        window.location="index.php";
    }
</script>