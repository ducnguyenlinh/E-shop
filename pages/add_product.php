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
if (isset($_POST["btn_add"])) {
    // var_dump($_POST);die;
    $name = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $mass = $_POST['mass'];
    $image = $_POST['image'];
    $category_id = $_POST['category_id'];
    $number_of_page = $_POST['number'];
    $publisher = $_POST['publisher'];
    $date_published = $_POST['published'];
    $quantity_in = $_POST['quantity_in'];
    $created_at = date("Y-m-d");
    if ($name == null || $author == null || $price == null || $size == null || $mass == null || $image == null ||
        $number_of_page == null || $publisher == null || $date_published == null || $quantity_in == null
    )
        $error = "*no field empty!";
    else {
        $sql = "select * from book_info where name = '$name'";
        $query = pg_query($conn, $sql);
        $num_rows = pg_num_rows($query);
        if ($num_rows != 0)
            $error = "the list books had this book!";
        else {
            $result = pg_query($conn, "SELECT id FROM book_info ORDER BY id DESC LIMIT 1");
            $row = pg_fetch_assoc($result);
            $id = $row['id'];
            $id = $id + 1;
            $result = pg_query($conn, "INSERT INTO
                 book_info(id,category_id,name,author,price,size,mass,image,number_of_page,publisher,date_published,created_at,view) 
                   VALUES(" . $id . "," . $category_id . ",'$name','$author','$price','$size','$mass','$image'," . $number_of_page . ",'$publisher','$date_published','$created_at',0);");
            echo "<script type='text/javascript'>swal('this book added!');</script>";
        }
    }
}
?>

<div id="wrapper">
    <?php include "header.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <h3 class="page-header">Add Product</h3>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>New Book</strong>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="add_product.php">
                                <fieldset>
                                    <?php
                                    if (!empty($error)) {
                                        echo '<div style="color:#FF0012"> ' . $error . '</div>';
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label>Title</label>

                                        <input class="form-control" name="title" placeholder="Enter title">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Author</label>
                                        <input class="form-control" name="author">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category_id">
                                            <?php
                                            $result = pg_query($conn, "SELECT * FROM category ORDER BY category_id ASC");
                                            while ($row = pg_fetch_assoc($result)) {
                                                ?>
                                                <option class="category_product"
                                                        value="<?php echo $row['category_id']; ?>">
                                                    <?php echo $row['category_name']; ?></option>;
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <label>Image</label>
                                            <!-- <input type="file" class="upload_image" name="image"> -->
                                            <input class="form-control upload_image" name="image">
                                        </div>
                                        <div class="show_image_here">
                                        </div>
                                        <div class="form-group" id="uploaded_image">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group col-lg-6">
                                            <label>Price</label>
                                            <input class="form-control" name="price">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Size</label>
                                            <input class="form-control" name="size">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Mass</label>
                                            <input class="form-control" name="mass">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Number of pages</label>
                                            <input class="form-control" name="number">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label>Publisher</label>
                                            <input class="form-control" name="publisher">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Date Published</label>
                                            <input class="form-control" name="published">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Quantity</label>
                                            <input class="form-control" name="quantity_in">
                                        </div>
                                        <div class="form-group col-lg-3 col-lg-offset-3">
                                            <label></label>
                                            <input type="submit" value="Submit" name="btn_add" class="btn btn-primary">
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
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
<script type="text/javascript" src="../dist/js/ajax_product.js"></script>

</body>

</html>
