<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<?php
    include "connect.php";
    include "function.php";
?>
<head>

    <!-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- <link href="../dist/css/style.css" rel="stylesheet"> -->

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="../dist/js/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="../dist/css/sweetalert.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <?php 
        if(isset($_GET['page']))
        $page=$_GET['page']-1;
    else
        $page = 0;
     ?>
<div id="wrapper">
    <?php include "header.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                     <h1 class="page-header">Category</h1>
                </div>
                    <div class="col-lg-10 col-lg-offset-1">
                        <a class="btn btn-primary fa fa-plus add_category col-lg-offset-10">
                         Add category
                         </a>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center">Order id</th>
                                        <th style="text-align: center">Receiver</th>
                                        <th style="text-align: center">Amount</th>
                                        <th style="text-align: center">Order At</th>
                                        <th style="text-align: center">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $result = pg_query($conn, "SELECT order_id FROM order_info where status!=0 ORDER BY order_id DESC");
                                    $sum = pg_num_rows($result);
                                    $sum_of_page = 10;
                                    $start_of_page = $sum_of_page * $page;

                                    $result2 = pg_query($conn, "SELECT * FROM order_info where status!=0 ORDER BY order_created DESC LIMIT $sum_of_page OFFSET $start_of_page");
                                    while ($row = pg_fetch_assoc($result2)) {
                                        $order_id = $row['order_id'];
                                        $user_id = $row['user_id']; 
                                        ?>
                                        <tr class="row_<?= $order_id ?>">
                                            <td style="text-align: center"> 
                                                    <?php echo $i; $i++; ?> 
                                            </td>
                                            <td class="order_<?= $order_id ?>">
                                                <a style="color:black; text-decoration:none">
                                                    <?php echo $order_id; ?>
                                                </a>
                                            </td>
                                            <td class="">
                                                <?php 
                                                $result3 = pg_query($conn, "SELECT user_name from user_info WHERE user_id='$user_id'");
                                                $row2 = pg_fetch_assoc($result3);
                                                echo $row2['user_name'];
                                                 ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $result4 = pg_query($conn, "SELECT * from order_item where order_id= '$order_id'");
                                                $sum_of_item = pg_num_rows($result4);
                                                $row3 = pg_fetch_assoc($result4);
                                                $k=0; 
                                                $amount=0;
                                                for($k=0;$k<$sum_of_item;$k++){
                                                    $re = pg_query($conn,"SELECT item_id,quantity FROM order_item WHERE order_id='$order_id' LIMIT 1 OFFSET $k");
                                                    $row4 = pg_fetch_assoc($re);
                                                    $item_id = $row4['item_id'];
                                                    $quantity = $row4['quantity'];
                                                    $re2= pg_query($conn, "SELECT price FROM book_info WHERE id = '$item_id'");
                                                    $row5 = pg_fetch_assoc($re2); // đưa giá từ string về int.
                                                    $price = $row5['price'];
                                                    $a=strlen($price);
                                                    $price = cutString($price,$a-6);
                                                    $price = (int)$price;
                                                    $amount = $amount + $quantity * $price;
                                                } 
                                                echo $amount.".000đ";                                               
                                                ?>
                                            </td>
                                            <td>
                                                <?= $row['order_created'] ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                if($row['status']==1)
                                                    echo "<button onclick='myFunction(".$row['order_id'].")'>Send</button> ";
                                                else if($row['status']==2)
                                                    echo "Sent";    
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                    <?php 
                                    echo '<ul class="pagination">';
                                        if($page!=0)    echo'<li><a href="transport.php?page='.($page).'">&laquo;</a></li>';
                                        else            echo'<li><a href="transport.php?page='.($page+1).'">&laquo;</a></li>';
                                        for ($i=0; $i < ($sum/$sum_of_page) ; $i++) {
                                        if($page==$i)
                                            echo '<li class="active"><a href="transport.php?page='.($i+1).'">'.($i+1).'</a></li>';
                                        else
                                            echo '<li><a href="transport.php?page='.($i+1).'">'.($i+1).'</a></li>';
                                        }
                                        if($page<(($sum/$sum_of_page)-1))  echo '<li><a href="transport.php?page='.($page+2).'">&raquo;</a></li>';
                                        else        echo'<li><a href="transport.php?page='.($page+1).'">&raquo;</a></li>';
                                    echo'</ul>';

                                     ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="transport.js"></script>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
<script>
 function myFunction(order_id) {
    // alert(order_id);
    $.ajax({
        url: 'add_transport.php?',
        type: 'POST',
        dataType: 'text',
        data: {order_id: order_id},
        success : function(data){
            // alert(data);
            location.reload(true); 
        }
    });
}
</script>