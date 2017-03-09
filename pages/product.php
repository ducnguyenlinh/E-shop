<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<?php include "connect.php" ?>
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
?>
<div id="wrapper">
    <?php include "header.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <strong class="col-lg-2">Product</strong>
                            <form class="col-lg-8">
                                <div class="form-group col-lg-6">
                                    <select class="form-control" name="select" id="change_link">
                                        <option value="0">
                                            Select a item
                                        </option>
                                        <?php
                                        $result = pg_query($conn, "SELECT * FROM category ORDER BY category_id ASC");
                                        while ($row = pg_fetch_assoc($result)) {
                                            ?>
                                            <option class="category_product"
                                                    value="<?php echo $row['category_id']; ?>" >
                                                <?php echo $row['category_name']; ?></option>;
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </form>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div>
                        <a class="btn btn-primary fa fa-plus" href="add_product.php">
                            Add product
                        </a>
                    </div>

                    <div class="col-lg-12" style="margin:auto">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $id = $_GET['id'];
                                        $result_count = pg_query($conn, "SELECT id FROM book_info WHERE category_id='$id' ORDER BY category_id DESC");
                                        $sum = pg_num_rows($result_count);
                                        $sum_of_page = 10;
                                        $i = 1;
                                        $start_of_page = $sum_of_page * $page;
                                        $result = pg_query($conn, "SELECT id,name,price,quantity_in FROM book_info WHERE category_id='$id' ORDER BY category_id DESC LIMIT 
                                            $sum_of_page OFFSET $start_of_page");
                                        while ($row = pg_fetch_assoc($result)) {
                                            $id_b = $row['id'];
                                            ?>
                                            <tr class="row_product<?= $id ?> odd gradeX">
                                                <td style="text-align: center">
                                                    <?php echo $i;
                                                    $i++; ?>
                                                </td>
                                                <td>
                                                    <a style="color:black; text-decoration:none"
                                                       href="edit_product.php?id=<?= $row['id'] ?>">
                                                        <?php echo $row['name'] ?></a>
                                                </td>
                                                <td>
                                                    <?php echo $row['price'] ?>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $a = $row['quantity_in'];
                                                    echo $a;
                                                    ?>
                                                </td>
                                                <td style="text-align: center">
                                                    <a
                                                        href="edit_product.php?id=<?= $id ?>"
                                                        class="btn btn-primary fa fa-edit fa-fx edit_product"
                                                        id="edit_product<?= $row['id'] ?>"
                                                        >
                                                        Edit</a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a class="btn btn-danger fa fa-trash fa-fx delete_product"
                                                       id="<?= $row['id'] ?>"> Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    echo '<ul class="pagination">';
                                    if ($page != 0) echo '<li><a href="product.php?id=' . $id . '&page=' . ($page) . '">&laquo;</a></li>';
                                    else            echo '<li><a href="product.php?id=' . $id . '&page=' . ($page + 1) . '">&laquo;</a></li>';
                                    for ($i = 0; $i < ($sum / $sum_of_page); $i++) {
                                        if ($page == $i)
                                            echo '<li class="active"><a href="product.php?id=' . $id . '&page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
                                        else
                                            echo '<li><a href="product.php?id=' . $id . '&page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
                                    }
                                    if ($page < (($sum / $sum_of_page) - 1)) echo '<li><a href="product.php?id=' . $id . '&page=' . ($page + 2) . '">&raquo;</a></li>';
                                    else        echo '<li><a href="product.php?id=' . $id . '&page=' . ($page + 1) . '">&raquo;</a></li>';
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
                <!-- /.box -->
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

</body>

</html>
<script type="text/javascript">
$('#change_link').bind('change', function () { // bind change event to select
        var url = $(this).val(); // get selected value
        if (url != '') { // require a URL
            window.location = "product.php?id="+url; // redirect
        }
        return false;
    });

</script>