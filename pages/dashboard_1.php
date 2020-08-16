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
                    $hidden = "";
                    $hidden1 = "";
                } else {
                    $hidden = "";
                    $hidden1 = "";
                }
                $exam = "";
                $class = "";
                if (isset($_GET['exam'])) {
                    $exam = $_GET['exam'];
                }

                $performance_query = "";
                if ((Input::exists() && Input::get("exam")) || isset($_GET['exam'])) {
                    $exam = Input::get("exam");
                    $class = Input::get("class");
                    $subject = Input::get("subject");
                    $performance_query = "SELECT * FROM staff_performance where Exam_Id='$exam' order by Staff_Performance desc";
                    $performance_list = DB::getInstance()->querySample($performance_query);
                    $Exam_Name = DB::getInstance()->displayTableColumnValue("select Exam_Name from exam where Id='$exam'", "Exam_Name");
                    $Subject_Name = DB::getInstance()->displayTableColumnValue("select Subject_Name from subject where Id='$subject'", "Subject_Name");
                    $Class_Name = DB::getInstance()->displayTableColumnValue("select Class_Name from class where Id='$class'", "Class_Name");


                    $class_query = "select staff.Class_Id,class.Class_Name from staff,staff_performance,class where staff.Staff_Id=staff_performance.Staff_Id 
                        and class.Id=staff.Class_Id and staff_performance.Exam_Id='$exam' group by staff.Class_Id";
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
                        <?php
                        if ((isset($_SESSION['hospital_role']) && ($_SESSION['hospital_role'] == "Student")) && !isset($_SESSION['immergencepassword'])) {
                            
                        } else {
                            ?>
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
                                                <form target="_blank"action="index.php?page=<?php echo "results" . "&type=download_results&exam=" . $exam . "&subject=" . $subject . "&class=" . $class; ?>" method="POST">
                                                    <button type="submit"class="btn btn-success fa fa-print pull-right">Print</button>

                                                </form>  
                                            </div>
                                            <div class="card-body " id="bar-parent">

                                                <div class="col-md-12">
                                                    <form method="post" action="index.php?page=<?php echo "dashboard" . '&mode=' . $mode; ?>">
                                                        <div class="form-group col-md-3">

                                                            <label>Subject:</label>
                                                            <select name="subject" class="select2"  style="width: 100%" onchange="returnexam(this.value, 'exam_data');" required>
                                                                <option value="">select</option>
                                                                <?php
                                                                $query = "select * from subject WHERE  Status=1";
                                                                if (DB::getInstance()->checkRows($query)) {
                                                                    $subject_query = DB::getInstance()->query($query);
                                                                    foreach ($subject_query->results() as $subject) {
                                                                        echo '<option value="' . $subject->Id . '">' . $subject->Subject_Name . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>

                                                        <div class="col-md-3" id="exam_data">

                                                        </div>
                                                        <div class="box-footer col-md-3">
                                                            <br/>
                                                            <button type="submit"  name="search" value="search" class="btn btn-success fa fa-search pull-right">search</button>
                                                            <br/>
                                                            <br/>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="col-md-12">
                                                    <?php
                                                    if ((Input::exists() && Input::get("exam")) || isset($_GET['exam'])) {

                                                        $policydoneQuery = "select * from policy_codes where Exam_Id='$exam' AND Status=0";
                                                        $PendingpolicydoneQuery = "select * from policy_codes where Exam_Id='$exam' AND Status=1";

                                                        $PolicydoneData = DB::getInstance()->querySample($policydoneQuery);
                                                        $PendingpolicydoneData = DB::getInstance()->querySample($PendingpolicydoneQuery);
                                                        if (DB::getInstance()->checkRows($performance_query)) {
                                                            ?>
                                                            <a style="color:blue; font-size: 20px;"><b><center>Students Performance For <?php echo $Subject_Name ?> <?php echo $Exam_Name ?> <?php echo $Class_Name ?> </center></b></a>
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
                                                                    $overall_marks = DB::getInstance()->calculateSum("select Total_Marks from total_correct_answer where Exam_Id='$exam' ", 'Total_Marks');

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
                                                            echo '<div class="alert alert-danger">No Results for ' . $Subject_Name . ' ' . $Exam_Name . ' ' . $Class_Name . ' to display</div>';
                                                        }
                                                        ?>
                                                        <div class="col-lg-12 table-bordered ">
                                                            <div class="col-lg-6 table-bordered " style="color: blue;">pending</div>
                                                            <div class="col-lg-6 table-bordered" style="color: blue">answered</div>
                                                            <div class="col-lg-6 table-bordered">
                                                                <?php
                                                                $k = 1;
                                                                foreach ($PendingpolicydoneData as $pendingPolicy) {
                                                                    ?>
                                                                    <div><?php echo $k . ". " . DB::getInstance()->displayTableColumnValue("select Staff_Name from staff where Staff_Id='$pendingPolicy->Staff_Id'", 'Staff_Name') ?></div> 
                                                                    <?php
                                                                    $k++;
                                                                }
                                                                ?>
                                                            </div>

                                                            <div class="col-lg-6 table-bordered"> <?php
                                                                $i = 1;
                                                                foreach ($PolicydoneData as $policydone) {
                                                                    ?>
                                                                    <div><?php echo $i . ". " . DB::getInstance()->displayTableColumnValue("select Staff_Name from staff where Staff_Id='$policydone->Staff_Id'", 'Staff_Name') ?></div>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>

                                                        <?php
                                                    } else {
                                                        echo '<div class="alert alert-danger">No Results to display</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div></div></div>
                        <?php } ?>

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
        <script type="text/javascript">

        </script>

        <script src="js/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="js/counterup/jquery.counterup.min.js" type="text/javascript"></script>

        <script src="js/chart-js/Chart.bundle.js" type="text/javascript"></script>
        <script src="js/chart-js/utils.js" type="text/javascript"></script>
        <script src="js/chart-js/chartjs-data.js" type="text/javascript"></script>
    </body>

</html>