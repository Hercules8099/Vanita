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

$name="SELECT DISTINCT name FROM sales";
$name_re=mysqli_query($conn,$name);
// $name_row=mysqli_fetch_array($name_re);

// $query11="SELECT * FROM sales";
// $result11=mysqli_query($conn,$query11);

?>
<!-- <h2 class="rem-amt" id="amt"></h2> -->
<input class="back-btn" type="button" name="back" onclick="back()" value="back"></input>
<div class="main-row" style="width: 100%;">
<div class="main-table" style="overflow-x:auto;width:50%;margin:auto">
    <h2>ઉધાર વિગત</h2>
    <hr>
    <table id="example" class="table display nowrap" style="width: 100%;margin-top:10px;">
        <thead>
            <tr class="tr">
                <th>તારીખ</th>
                <th>નામ</th>
                <!-- <th>રકમ ઉધાર</th> -->

            </tr>
        </thead>
        <tbody>
            <?php
            foreach($name_re as $row2)
            {
                $total=0;
                $query="SELECT * FROM sales WHERE `name`='$row2[name]'";
                $result=mysqli_query($conn,$query);

                foreach ($result as $row) {
                    $total=$total+$row['weight']*$row['rate']+$row['comi']+$row['labor'];
                }
                // echo "t".$total." ";

                $totalp=0;
                $query1="SELECT * FROM paid WHERE `name`='$row2[name]'";
                $result1=mysqli_query($conn,$query1);

                foreach($result1 as $row1)
                {
                    $totalp=$totalp+$row1['paid'];
                }
                // echo "p".$totalp."<br>";
                if($total>$totalp)
                {
                    $gtotal=$total-$totalp;
                // }
            // }
            ?>
            <tr>
                <td><?php echo $row2['name']; ?></td>
                <td><?php echo $gtotal; ?></td>
            </tr>
                <?php
            }
        }
            ?>
        </tbody>
        <tfoot>
            <tr class="tr">
                <th></th>
                <th></th>
                <!-- <th></th> -->
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