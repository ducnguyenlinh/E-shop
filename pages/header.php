<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.html">Admin Control</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    <li><a href="../../ci-eshop"><i class="fa fa-home fa-2x"></i></a></li>
    <li class="dropdown">
        <ul class="dropdown-menu dropdown-messages">
            <li>
                <a href="#">
                    <div>
                        <strong>Admin</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                    </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                    </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                    </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="text-center" href="#">
                    <strong>Read All Messages</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-messages -->
    </li>
    <!-- /.dropdown -->

    <!-- /.dropdown -->
    <li class="dropdown">
        <ul class="dropdown-menu dropdown-alerts">
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> New Comment
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                        <span class="pull-right text-muted small">12 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-tasks fa-fw"></i> New Task
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="text-center" href="#">
                    <strong>See All Alerts</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-alerts -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="profile_admin.php"><i class="fa fa-user fa-fw"></i>
                    <?php
                    $email = $_SESSION['email'];
                    $sql = "SELECT * FROM admin where email = '$email' ";
                    $result = pg_query($conn, $sql);
                    $row = pg_fetch_assoc($result);
                    echo $row['name'];
                    ?>
                </a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" id="input_search" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn_search" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="statistics.php"><i class="fa fa-bar-chart-o fa-fw"></i> Statistics</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-table fa-fw"></i> Control Product<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="category.php">Category</a>
                    </li>
                    <li>
                        <a href="#">Product<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="product.php?id=1">Product List</a>
                            </li>
                            <li>
                                <a href="add_product.php">Add product</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-table fa-fw"></i>Order<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="order.php?status=3">All order</a>
                    </li>
                    <li>
                        <a href="order.php?status=1">New order</a>
                    </li>
                    <li>
                        <a href="order.php?status=2">Sented order</a>
                    </li>
                    <li>
                        <a href="order.php?status=0">Canceled order</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="customer.php"><i class="fa fa-table fa-fw"></i>Customers</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> System<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin_information.php">Admin</a>
                    </li>
                    <li>
                        <a href="backup_restore.php">Backup and restore</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Modules<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="transport.php?page=1">Transports</a>
                    </li>
                    <li>
                        <a href="payment.php">Payments</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>