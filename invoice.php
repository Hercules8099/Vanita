<?php
    include('conn.php');
    // include('nav.php');

    $id=$_POST['name'];
    $date=$_POST['date'];

    $date1 = explode('-', $date);
    $newdate=$date1[2]."-".$date1[1]."-".$date1[0];

    // echo $newdate;

    $query="SELECT * from sales WHERE `id` = '$id' ";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result);

    //  $name_res=mysqli_query($conn,$name);

    // echo $row['name'];

    $name="SELECT * FROM sales WHERE `name`='$row[name]' and `date`<='$newdate'";
    $name_res=mysqli_query($conn,$name);

    $pa="SELECT * FROM paid WHERE `name`='$row[name]'";
    $pa_res=mysqli_query($conn,$pa);

    $pa1="SELECT * FROM paid WHERE `name`='$row[name]' order by `id` DESC";
    $pa_res1=mysqli_query($conn,$pa1);
    $rowp1=mysqli_fetch_array($pa_res1);

    $query1="SELECT * FROM sales WHERE `name`='$row[name]' and `date`='$newdate'";
    $result1=mysqli_query($conn,$query1);

    // echo $row['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>બિલ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <style>@page { size: A5;}</style>
    <link rel="stylesheet" href="assets/css/invoice.css">
</head>
<style> 
@media print {
    .print-hide {
        visibility: hidden;
    }
}
.back-btn
{
    position: absolute;
    height: auto;
    width: auto;
    color: rgb(125, 0, 0);
    top:60px;
    z-index: 1000;
    margin: 5px 10px;
    padding: 10px;
    border-radius: 10px;

}
</style>
<body class="A5">
<!-- <input class="back-btn" type="button" name="back" onclick="back()" value="back"> -->
    <div class="container bootstrap snippets bootdey">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6 text-left">
                        <h3><strong>ANK</strong></h3>
                        <ul class="list-unstyled">
                            <li><strong>નામ :</strong> <?php echo $row['name'];?></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-6 text-right">
                        <h4><strong></strong> </h4>
                        <ul class="list-unstyled">
                            <li><strong>તારીખ : </strong>  <?php echo $date;?></li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-condensed nomargin">
                        <thead>
                            <tr>
                                <th>માલ ની વિગત</th>
                                <th>દાગીના</th>
                                <th>વજન</th>
                                <th>ભાવ</th>
                                <th>કુલ રકમ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total=0;
                                $comi=0;
                                $lab=0;
                                foreach($result1 as $row1)
                                {
                                    $item="SELECT * FROM items WHERE `id`='$row1[item]'";
                                    $i_result=mysqli_query($conn,$item);
                                    $i_row=mysqli_fetch_array($i_result);
                            ?>
                            <tr>
                                <td><div><strong><?php echo $i_row['name'];?></strong></div></td>
                                <td><?php echo $row1['qty'];?></td>
                                <td><?php echo $row1['weight'];?></td>
                                <td><?php echo $row1['rate'];?></td>
                                <?php
                                    $rate=$row1['weight']*$row1['rate']+$row1['comi']+$row1['labor'];
                                    $rate1=$row1['weight']*$row1['rate'];
                                    $total = $total + $rate1;
                                    $comi = $comi + $row1['comi'];
                                    $lab = $lab + $row1['labor'];
                                ?>
                                <td><?php echo $rate1;?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?PHP
                    $t=0; 
                    foreach($name_res as $row2)
                    {   
                        $rate=$row2['weight']*$row2['rate']+$row2['comi']+$row2['labor'];
                        $t = $t + $rate;
                    }

                    $p=0; 
                    foreach($pa_res as $rowp)
                    {   
                        // $abc=$row1['weight']*$row1['rate']+$row1['comi']+$row1['labor'];
                        $p = $p + $rowp['paid'];
                    }

                ?>

                <hr class="nomargin-top">
                <div class="row">
                    <div class="col-sm-6 text-left" style="width:50%">
                    <ul class="list-unstyled" style="width: 100%;">
                            <?php
                                $todaytotal=$total+$comi+$lab;
                                // $todaytotal=1020;
                                $remaining=$t-$p-$todaytotal;
                                if($remaining<=0)
                                {
                                    $remaining='0';
                                    // echo "yes";
                                }
                                else{
                                    $remaining=$t-$p-$todaytotal;
                                    // echo "yes";
                                }
                                // $remaining=$t-$p-$todaytotal;
                                $subt=$total+$comi+$lab+$remaining;
                            ?>
                            <li><strong>આગડ ના બાકી &nbsp;: </strong> <?php echo $remaining;?></li>
                            <li><strong>આજના બાકી &nbsp;&nbsp;&nbsp;&nbsp;: </strong> <?php echo round($todaytotal);?></li>
                            <li><strong>છેલ્લા જમા &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong> <?php if(isset($rowp1['paid'])){ echo $rowp1['paid'];}else{echo 0;}?></li>
                            <li><strong>છેલ્લા જમા તા. &nbsp;&nbsp;: </strong> <?php if(isset($rowp1['date'])){ echo $rowp1['date'];}else{echo ' --- ';}?></li>
                            <li><strong>કુલ્લ બાકી &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong> <?php echo round($subt);?></li>
                        </ul>
                    </div>
                    <!-- <div class="col-sm-6 text-right"> -->
                    <div class="col-sm-6 text-right">
                        <ul class="list-unstyled" style="width: 100%;">
                            <li><strong>કુલ: </strong> <?php echo round($total);?></li>
                            <li><strong>કમિશન : </strong> <?php echo $comi;?></li>
                            <li><strong>મજૂરી : </strong> <?php echo $lab;?></li>
                            <li><strong>નેટ : </strong> <?php echo round($total+$comi+$lab);?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="panel panel-default text-right print-hide">
            <div class="panel-body">
                <a class="btn btn-warning" href="#"><i class="fa fa-pencil-square-o"></i> EDIT</a>
                <a class="btn btn-primary" href="#"><i class="fa fa-check"></i> SAVE</a>
                <a class="btn btn-success" href="page-invoice-print.html" target="_blank"><i class="fa fa-print"></i> PRINT INVOICE</a>
            </div>
        </div> -->
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">

function back()
{
  window.location="index.php";
}

    </script>
</body>

</html>