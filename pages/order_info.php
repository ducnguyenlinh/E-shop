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
<div id="wrapper">
    <?php include "header.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <h4 class="page-header"></h4>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>order info</strong>
                        </div>
                        <div class="panel-body">
                            <form>
                                <fieldset>
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $order_id = $_GET['id'];
                                    }
                                    $result = pg_query($conn, "SELECT * FROM order_info WHERE order_id='$order_id'");
                                    while ($row = pg_fetch_assoc($result)) {
                                    $user_id = $row['user_id'];
                                    $status = $row['status'];
                                    ?>

                                    <div style="font-size:20px">
                                        <div class="form-group col-lg-2">
                                            <p class="form-control-static">
                                                ID ORDER:
                                            </p>
                                        </div>
                                        <div class="form-group col-lg-10">
                                            <p class="form-control-static">
                                                <?php echo $order_id; ?>
                                            </p>
                                        </div>


                                        <div class="form-group col-lg-2">
                                            <p class="form-control-static">
                                                RECEIVER:
                                            </p>
                                        </div>
                                        <div class="form-group col-lg-10">
                                            <p class="form-control-static">
                                                <?php
                                                $re = pg_query($conn, "SELECT user_name from user_info WHERE user_id='$user_id'");
                                                $r = pg_fetch_assoc($re);
                                                echo $r['user_name'];
                                                ?>
                                            </p>
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <p class="form-control-static">
                                                ADDRESS:
                                            </p>
                                        </div>
                                        <div class="form-group col-lg-10">
                                            <p class="form-control-static">
                                                <?php
                                                echo $row['address'];
                                                echo ", ";
                                                $district = $row['district'];

                                                $re = pg_query($conn, "SELECT * FROM district WHERE id='$district'");
                                                $r = pg_fetch_assoc($re);
                                                echo $r['ten'];

                                                echo ", ";
                                                $city = $row['city'];
                                                $re = pg_query($conn, "SELECT ten FROM city WHERE id='$city'");
                                                $r = pg_fetch_assoc($re);
                                                echo $r['ten'];
                                                ?>
                                            </p>
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <p class="form-control-static">
                                                TOTAL:
                                            </p>
                                        </div>
                                        <div class="form-group col-lg-10">
                                                    <p class="form-control-static">
                                                      <?php 
                                                        echo $row['total'] .'.000đ';
                                                     ?>
                                                </div>
                                                <div class="form-group col-lg-10">
                                                    <p class="form-control-static">
                                                        
                                                    </p>
                                                </div>
                                        
                                        <div class="table-responsive table-bordered col-lg-10 col-lg-offset-1">
                                            <table class="table table-hover" style="font-size:15px">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $k = 1;
                                                if($status==0){
                                                    $re = pg_query($conn, "SELECT quantity,price,name FROM order_item_deleted LEFT JOIN book_info  on book_info.id =item_id WHERE order_id= '$order_id'");
                                                    $row4 = pg_fetch_all($re);
                                                } else {
                                                    $re = pg_query($conn, "SELECT quantity,price,name FROM order_item LEFT JOIN book_info  on book_info.id =item_id WHERE order_id= '$order_id'");
                                                    $row4 = pg_fetch_all($re);
                                                }
                                                foreach ($row4 as $row_4) {
                                                    ?>
                                                    <tr class="info">
                                                        <td><?php echo $k;
                                                            $k++; ?></td>
                                                        <td><?php echo $row_4['name'] ?></td>
                                                        <td><?php echo $row_4['quantity'] ?></td>
                                                        <td><?php echo $row_4['price'] ?></td>
                                                        <td>
                                                            <?php echo $row_4['price'] * $row_4['quantity'] . ".000đ" ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </fieldset>
                            </form>
                            <div class="panel-footer">
                                <div class="form-group col-lg-12">
                                    <?php
                                    if ($row['status'] == 1) {
                                        echo '
                                        <div class=" col-lg-8">
                                        <p class="text-danger" style="font-size:20px"> <strong>Status:New</strong></p>
                                    </div>
                                    <div class=" col-lg-4">
                                        <a class="btn btn-primary order_sent" value="1" name="' . $order_id . '">Sent now</a>
                                    </div>';
                                    } else if ($row['status'] == 2) {
                                        echo '
                                        <div class=" col-lg-8">
                                        <p class="text-danger" style="font-size:20px"> <strong>Status:Sented</strong></p>
                                    </div>
                                    <div class=" col-lg-4">
                                        <a class="btn btn-primary order_sent" value="2" name="' . $order_id . '">Cancel Sent</a>
                                    </div>';
                                    } else {
                                        echo '
                                    <div class=" col-lg-8">
                                        <p class="text-danger" style="font-size:20px"> <strong>Status:Cancel</strong></p>
                                    </div>';
                                    }
                                    ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
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
