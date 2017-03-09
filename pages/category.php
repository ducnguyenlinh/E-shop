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
                                    <th style="text-align: center">Categoryname</th>
                                    <th style="text-align: center">Edit</th>
                                    <th style="text-align: center">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                $result = pg_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                                while ($row = pg_fetch_assoc($result)) {
                                    ?>

                                    <tr class="row_category<?= $row['category_id'] ?>">
                                        <td style="text-align: center"> <?php echo $i;
                                            $i++; ?> </td>
                                        <td class="category_<?= $row['category_id'] ?>">

                                            <div class="category_name<?= $row['category_id'] ?>">
                                                <a style="color:black; text-decoration:none"
                                                   href="product.php?id=<?= $row['category_id'] ?>">
                                                    <?php echo $row['category_name']; ?>
                                                </a>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <a class="btn btn-primary fa fa-edit fa-fx edit_category"
                                               id="edit_category<?= $row['category_id'] ?>"
                                               name="<?= $row['category_name'] ?>"
                                               value="<?= $row['category_id'] ?>">
                                                Edit</a>
                                        </td>
                                        <td style="text-align: center">
                                            <a class="btn btn-danger fa fa-trash fa-fx delete_category"
                                               id="<?= $row['category_id'] ?>"> Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
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
<script type="text/javascript" src="../dist/js/ajax_category.js"></script>

</body>

</html>