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
                $hidden = "";
                $hidden1 = "";
                if ((isset($_SESSION['hospital_role']) && ($_SESSION['hospital_role'] == "Staff" || $_SESSION['hospital_role'] == "Staff")) && !isset($_SESSION['immergencepassword'])) {
                    $hidden = "hidden";
                    $hidden1 = "";
                } else {
                    $hidden = "";
                    $hidden1 = "hidden";
                }
                $subject = "";
                $class = "";
                if (isset($_GET['subject'])) {
                    $subject = $_GET['subject'];
                }

                $performance_query = "";
                if ((Input::exists() && Input::get("subject")) || isset($_GET['subject'])) {
                    $subject = Input::get("subject");
                    $class = Input::get("class");
                    $performance_query = "SELECT * FROM staff_performance where Subject_Id='$subject' order by Staff_Performance desc";
                    $performance_list = DB::getInstance()->querySample($performance_query);
                    $Subject_Name = DB::getInstance()->displayTableColumnValue("select Subject_Name from subject where Id='$subject'", "Subject_Name");
                    $Class_Name = DB::getInstance()->displayTableColumnValue("select Class_Name from class where Id='$class'", "Class_Name");
                }
                ?>
                <!-- end sidebar menu --> 
                <!-- start page content -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Dashboard</div>
                                </div>
                            </div>
                        </div>
                        <!-- start widget -->

                        <div id="printable"> 
                            <div class="row">
                                <div class="col-md-12 hidden">
                                    <div class="card card-topline-red">
                                        <div class="card-head">
                                            <header></header>
                                        </div>
                                        <div class="card-body " id="chartjs_polar_parent">
                                            <div class="row">
                                                <canvas id="chartjs_line" height="100"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row <?php echo $hidden1; ?>">
                                <div class="col-md-10 col-xs-12">
                                    <div class="card card-topline-green">
                                        <div class="card-head">
                                            <header>Performance </header>
                                            <form target="_blank"action="index.php?page=<?php echo "results" . "&type=download_results&subject=" . $subject . "&class=" . $class; ?>" method="POST">
                                                <button type="submit"class="btn btn-success fa fa-print pull-right">Print</button>

                                            </form>  
                                        </div>
                                        <div class="card-body " id="bar-parent">

                                            <div class="col-md-8">
                                                <form method="post" action="index.php?page=<?php echo "dashboard" . '&mode=' . $mode; ?>">
                                                    <div class="form-group col-md-4">
                                                        <label>Class:</label>
                                                        <select name="class" class="select2" style="width: 100%" onchange="returnsubject(this.value, 'uploadedData');" required>
                                                            <option value="">Choose...</option>
                                                            <?php
                                                            $qstn_list = DB::getInstance()->querySample("select * from class ORDER BY Id");
                                                            foreach ($qstn_list as $qtn):
                                                                echo '<option value="' . $qtn->Id . '">' . $qtn->Class_Name . '</option>';
                                                            endforeach;
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4" id="uploadedData">

                                                    </div>

                                                    <div class="box-footer col-md-3">
                                                        <br/>
                                                        <button type="submit"  name="search" value="search" class="btn btn-success fa fa-search pull-right">search</button>
                                                    </div>
                                                </form>

                                            </div>
                                            <div class="col-md-12">
                                                <?php
                                                if ((Input::exists() && Input::get("subject")) || isset($_GET['subject'])) {

                                                    if (DB::getInstance()->checkRows($performance_query)) {
                                                        ?>
                                                        <a style="color:blue; font-size: 20px;"><b><center>Students Performance For <?php echo $Subject_Name ?> <?php echo $Class_Name ?> </center></b></a>
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th >#</th>
                                                                    <th >Students</th>
                                                                    <th >Performance</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $overall_marks = DB::getInstance()->calculateSum("select Total_Marks from total_correct_answer where Subject_Id='$subject' ", 'Total_Marks');

                                                                $no = 1;
                                                                foreach ($performance_list as $staff_performance) {
                                                                    ?>
                                                                    <tr> 
                                                                        <td><?php echo $no; ?></td>
                                                                        <td><?php echo $staff_performance->Staff_Name; ?></td>
                                                                        <td><?php echo $performance = round((($staff_performance->Staff_Performance / $overall_marks) * 100)); ?>%</td>

                                                                    </tr>
                                                                    <?php
                                                                    $no++;
                                                                }
                                                                ?>
                                                            </tbody>

                                                        </table>
                                                        <?php
                                                    } else {
                                                        echo '<div class="alert alert-danger">No Results for ' . $Subject_Name . ' ' . $Class_Name . ' to display</div>';
                                                    }
                                                } else {
                                                    echo '<div class="alert alert-danger">No Results to display</div>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div></div></div>
                    </div>
                </div>
                <!-- end page content -->
            </div>
            <!-- end page container -->
            <!-- start footer -->
            <?php include_once 'includes/footer.php'; ?>
            <!-- end footer -->
        </div>
        <script>
            var uniquequestion18Array = <?php echo json_encode($uniquequestion18Array); ?>;
            var uniqueCategoriesData = <?php echo json_encode($uniqueCategoriesArray); ?>;
            var uniquequestion119Array = <?php echo json_encode($uniquequestion119Array); ?>;
            var generalquestionArray = <?php echo json_encode($generalquestionArray); ?>;


        </script>
        <?php include_once 'includes/footer_js.php'; ?>
        <script type="text/javascript">

        </script>

        <script src="js/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="js/counterup/jquery.counterup.min.js" type="text/javascript"></script>

        <script src="js/chart-js/Chart.bundle.js" type="text/javascript"></script>
        <script src="js/chart-js/utils.js" type="text/javascript"></script>
        <script src="js/chart-js/chartjs-data.js" type="text/javascript"></script>
    </body>

</html>