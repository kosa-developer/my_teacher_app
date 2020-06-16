<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once 'includes/header_css.php'; ?>
    </head>
    <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-blue">
        <div class="page-wrapper">
            <!-- start header -->
            <?php include_once 'includes/header_menu.php'; ?>
            <!-- end header -->
            <!-- start page container -->
            <div class="page-container">
                <!-- start sidebar menu -->
                <?php
                include_once 'includes/side_menu.php';
                ?>
                <!-- end sidebar menu --> 
                <!-- start page content -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class="col-md-12">
                                    <div class="nav-tabs-custom">
                                        <div class="row">
                                            <?php
                                            $queryCourse_Name = 'SELECT * FROM courses WHERE Status=1 ORDER BY Id' . $limit;
                                            if (DB::getInstance()->checkRows($queryCourse_Name)) {
                                                ?> 
                                                <ul class="nav nav-tabs"> 
                                                    <?php
                                                    $data_got = DB::getInstance()->querySample($queryCourse_Name);
                                                    $no = 1;
                                                    foreach ($data_got as $Course_Namex) {
                                                        ?>
                                                        <li class="dropdown">
                                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                <?php echo $Course_Namex->Course_Name; ?> <span class="caret"></span>
                                                            </a>

                                                            <ul class="dropdown-menu">
                                                                <?php
                                                                $queryCourse_unit = 'SELECT * FROM course_unit WHERE Status=1 and Course_Id=' . $Course_Namex->Id . ' ORDER BY Course_Id' . $limit;
                                                                if (DB::getInstance()->checkRows($queryCourse_unit)) {
                                                                    ?>

                                                                    <?php
                                                                    $data_got = DB::getInstance()->querySample($queryCourse_unit);

                                                                    foreach ($data_got as $Course_unitx) {
                                                                        ?>
                                                                        <li role="presentation"><a role="menuitem" tabindex="-1"  onclick="searchcourse('<?php echo $Course_unitx->Id; ?>', 'returned_notes');"><?php echo $Course_unitx->Course_unit; ?></a></li>
                                                                        <?php
                                                                    }
                                                                    ?> <?php } else {
                                                                    ?>

                                                                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="searchcourse('', 'returned_notes');" alert alert-danger>No course unit registered</a></li>
                                                                <?php }
                                                                ?> </ul>

                                                        </li>  
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                                <?php
                                            } else {
                                                echo '<div class="alert alert-danger">No Courses registered</div>';
                                            }
                                            ?>
                                            <!-- /.tab-content -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- start widget -->

                        <div class="card card-topline-yellow">
                            <div class="card-head">
                                <header>Available notes</header>
                            </div>

                            <div class="card-body col-md-12" id="returned_notes">
                                <?php
                                if (isset($_GET['action']) && $_GET['action'] == 'delete') {

                                    $course_unit_id = $_GET['Id'];
                                    $query = DB::getInstance()->query("UPDATE notes SET Status=0 WHERE Id='$course_unit_id'");
                                    if ($query) {

                                        $Course_unit = DB::getInstance()->displayTableColumnValue("select Course_unit from course_unit where Id='$course_unit_id' ", "Course_unit");

                                        echo $message = "<center><h4 style='color:red'>data has been deleted successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=view_notes");
                                }
                                ?>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <!-- end page content -->
            </div>
            <!-- end page container -->
            <!-- start footer -->
<?php include_once 'includes/footer.php'; ?>
            <!-- end footer -->
        </div>

<?php include_once 'includes/footer_js.php'; ?>

    </body>

</html>