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
if (isset($_GET['page']))
    $page = $_GET['page'] - 1;
else
    $page = 0;
if (isset($_GET['status']))
    $status = $_GET['status'];
?>
<div id="wrapper">
    <?php include "header.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <h1 class="page-header">Order</h1>
                </div>
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table  table-bordered table-hover" style="text-align: center">
                                <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Order id</th>
                                    <th style="text-align: center">Receiver</th>
                                    <th style="text-align: center">Amount</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">View</th>
                                    <th style="text-align: center">Transport</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                if (isset($_GET['status'])) {
                                    $status = $_GET['status'];
                                    if ($status == 3) {
                                        $result = pg_query($conn, "SELECT order_id FROM order_info");
                                        $sum = pg_num_rows($result);
                                        $sum_of_page = 10;
                                        $start_of_page = $sum_of_page * $page;
                                        $result2 = pg_query($conn, "SELECT order_id,user_id,status,total FROM order_info ORDER BY order_created DESC LIMIT $sum_of_page OFFSET $start_of_page");
                                    } else {
                                        $result = pg_query($conn, "SELECT order_id,status FROM order_info WHERE status='$status'");
                                        $sum = pg_num_rows($result);
                                        $sum_of_page = 10;
                                        $start_of_page = $sum_of_page * $page;
                                        $result2 = pg_query($conn, "SELECT order_id,user_id,status,total FROM order_info WHERE status='$status' ORDER BY order_created DESC LIMIT $sum_of_page OFFSET $start_of_page");
                                    }
                                }

                                while ($row = pg_fetch_assoc($result2)) {
                                    $order_id = $row['order_id'];
                                    $user_id = $row['user_id'];
                                    ?>
                                    <tr class="row_<?= $order_id ?>">
                                        <td style="text-align: center">
                                            <?php echo $i;
                                            $i++; ?>
                                        </td>
                                        <td class="order_<?= $order_id ?>">
                                            <a style="color:black; text-decoration:none"
                                               href="order_info.php?id=<?= $order_id ?>">
                                                <?php echo $order_id; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php
                                            $result3 = pg_query($conn, "SELECT user_name from user_info WHERE user_id='$user_id'");
                                            $row2 = pg_fetch_assoc($result3);
                                            echo $row2['user_name'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $row['total'].'.000đ';
                                            ?>
                                        </td>
                                        <?php
                                        if ($row['status'] == 0)
                                            echo '<td style="text-align: center">Canceled</td>';
                                        if ($row['status'] == 1)
                                            echo '<td style="text-align: center">New</td>';
                                        if ($row['status'] == 2)
                                            echo '<td style="text-align: center">Sented</td>';
                                        ?>

                                        <td> 
                                        <a  href="order_info.php?id=<?= $order_id ?>"> View</a>
                                        </td>
                                           
                                        <td>
                                    <?php
                                    if ($row['status'] == 1) {
                                        echo '
                                        <a class="col-lg-8 col-lg-offset-2 btn btn-primary order_sent" value="1" name="' . $order_id . '">Sent now</a>
                                        ';
                                    } else if ($row['status'] == 2) {
                                        echo '
                                        <a class="col-lg-8 col-lg-offset-2 btn btn-info order_sent" value="2" name="' . $order_id . '">Cancel Sent</a>
                                        ';
                                    } else{
                                        echo '
                                        <a class="col-lg-8 col-lg-offset-2 btn btn-danger disabled" value="2" name="' . $order_id . '">Cancel order</a>
                                        ';
                                    }
                                    ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <?php
                                echo '<ul class="pagination">';
                                if ($page != 0) echo '<li><a href="order.php?status=' . $status . '&page=' . ($page) . '">&laquo;</a></li>';
                                else            echo '<li><a href="order.php?status=' . $status . '&page=' . ($page + 1) . '">&laquo;</a></li>';
                                for ($i = 0; $i < ($sum / $sum_of_page); $i++) {
                                    if ($page == $i)
                                        echo '<li class="active"><a href="order.php?status=' . $status . '&page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
                                    else
                                        echo '<li><a href="order.php?status=' . $status . '&page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
                                }
                                if ($page < (($sum / $sum_of_page) - 1)) echo '<li><a href="order.php?status=' . $status . '&page=' . ($page + 2) . '">&raquo;</a></li>';
                                else        echo '<li><a href="order.php?status=' . $status . '&page=' . ($page + 1) . '">&raquo;</a></li>';
                                echo '</ul>';
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
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
<script type="text/javascript" src="../dist/js/ajax_order.js"></script>

</body>

</html>