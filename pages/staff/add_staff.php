<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->

    <head>
        <?php include_once 'includes/header_css.php'; ?>
    </head>
    <!-- END HEAD -->
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

                $query_number = DB::getInstance()->displayTableColumnValue("select Code from staff order by Staff_Id desc Limit 1", "Code");
                $number = $query_number + 1;
                if (isset($_GET['mode'])) {
                    echo $mode = $_GET['mode'];

                    if ($mode == 'register') {
                        $hidden = "";
                        $class_width = "col-md-7";
                        $limit = "limit 10";
                    } else {
                        $hidden = "hidden";
                        $class_width = "col-md-12";
                        $limit = "";
                    }
                }
                $class_id = "";
                if (isset($_GET['class'])) {
                    $class_id = Input::get("class");
                }
                if (Input::exists() && Input::get("search") == "search") {
                    $class_id = Input::get("class");
                }
                ?>
                <!-- end sidebar menu -->
                <!-- start page content -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Student</div>
                                </div>
                                <div class="actions panel_actions pull-right">
                                    <a class="btn btn-primary" href="index.php?page=<?php echo "add_staff" . '&mode=' . $modez = ($mode == 'registered') ? 'register' : 'registered'; ?>"><i class="fa fa-eye"></i><?php echo $modez = ($mode == 'registered') ? 'Register' : 'Registered'; ?> Students</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-5" <?php echo $hidden; ?>>
                                <?php
                                if ((isset($_SESSION['hospital_role']) && ($_SESSION['hospital_role'] == "Staff")) && !isset($_SESSION['immergencepassword'])) {
                                    $type = "Policy";
                                } else {
                                    $type = "Survey";
                                }

                                if (Input::exists() && Input::get("add_staff") == "add_staff") {
                                    $staff_id = strtoupper(Input::get('staff_id'));
                                    $staff_name = strtoupper(Input::get('staff_name'));
                                    $stuff_photo = ($_FILES['stuff_photo']['name']);
                                    $class = Input::get("class");
                                    $email = Input::get("email");


                                    if ($stuff_photo != "") {
                                        $target_dir = "staff_image/";
                                        $target_file = $target_dir . basename($_FILES["stuff_photo"]["name"]);
                                        move_uploaded_file($_FILES["stuff_photo"]["tmp_name"], $target_file);
                                    }
                                    $queryDup = DB::getInstance()->checkRows("select * from staff where Staff_Name='$staff_name' and Code='$staff_id'");
                                    if (!$queryDup) {
                                        DB::getInstance()->insert("staff", array(
                                            "Staff_Name" => $staff_name,
                                            "Code" => $staff_id,
                                            "Email" => $email,
                                            "Class_Id" => $class,
                                            "Image" => $stuff_photo));
                                        $message = $staff_name . " has been successfull regestered";
                                        echo "<h4 style='color:blue;'><center>" . $message . "</center></h4>";
                                        $log = $_SESSION['hospital_staff_names'] . "  registered a new staff :" . $staff_name;
                                        DB::getInstance()->logs($log);
                                    } else {
                                        echo "<h4 style='color:red;'><center>Staff already exists</center></h4>";
                                    }
                                    Redirect::go_to("index.php?page=add_staff&mode=" . $mode . "&class=" . $class_id);
                                }
                                ?>
                                <form role="form" action="index.php?page=<?php echo "add_staff" . '&mode=' . $mode . "&class=" . $class_id; ?>"method="POST" enctype="multipart/form-data">
                                    <div class="card card-topline-yellow">
                                        <div class="card-head">
                                            <header>Register a Student</header>
                                        </div>
                                        <div class="card-body " id="bar-parent">

                                            <div id="file_div">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Student Image</label>

                                                    <input type="file" id="i_file" name="stuff_photo" accept="image/*" onchange="readURL1(this);">

                                                    <img id="blah" src="staff_image/person.JPG" class="user-image" alt="User Image">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>RegNo.</label>
                                                <input type="text" class="form-control" name="staff_id" value="<?php echo $number; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="staff_name" placeholder="Enter student names" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Class:</label>
                                                <select name="class" class="select2" style="width: 100%" required>
                                                    <option value="">Choose...</option>
                                                    <?php
                                                    $qstn_list = DB::getInstance()->querySample("select * from class ORDER BY Id");
                                                    foreach ($qstn_list as $qtn):
                                                        echo '<option value="' . $qtn->Id . '">' . $qtn->Class_Name . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="Enter student email" required>
                                            </div>

                                            <div class="box-footer">
                                                <button type="submit"  name="add_staff" value="add_staff" class="btn btn-primary pull-right">Submit</button>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>

                            </div>
                            <!-- /.col (left) -->
                            <div class="<?php echo $class_width; ?>">
                                <?php
                                if (isset($_GET['action']) && $_GET['action'] == 'delete') {

                                    $staff_id = $_GET['staff_id'];
                                    $query = DB::getInstance()->query("UPDATE staff SET Status=0 WHERE Staff_Id='$staff_id'");
                                    if ($query) {

                                        $staff_name = DB::getInstance()->displayTableColumnValue("select Staff_Name from staff where Staff_Id='$staff_id' ", "Staff_Name");

                                        echo $message = "<center><h4 style='color:red'>data has been deleted successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=add_staff&mode=" . $mode . "&class=" . $class_id);
                                }
                                if (Input::exists() && Input::get("edit_staff") == "edit_staff") {
                                    $staff_id = Input::get('staff_id');
                                    $staff_code = strtoupper(Input::get('staff_code'));
                                    $staff_name = strtoupper(Input::get('staff_name'));
                                    $stuff_photo = ($_FILES['stuff_photo']['name']);
                                    $class = Input::get('class');
                                    $email = Input::get("email");

                                    $staff_namez = DB::getInstance()->displayTableColumnValue("select Staff_Name from staff where Staff_Id='$staff_id' ", "Staff_Name");

                                    if ($stuff_photo != "") {
                                        $target_dir = "staff_image/";
                                        $target_file = $target_dir . basename($_FILES["stuff_photo"]["name"]);
                                        move_uploaded_file($_FILES["stuff_photo"]["tmp_name"], $target_file);

                                        $editStaff = DB::getInstance()->update("staff", $staff_id, array(
                                            "Staff_Name" => $staff_name,
                                            "Code" => $staff_code,
                                            "Email" => $email,
                                            "Class_Id" => $class,
                                            "Image" => $stuff_photo), "Staff_Id");
                                    } else {

                                        $editStaff = DB::getInstance()->update("staff", $staff_id, array(
                                            "Staff_Name" => $staff_name,
                                            "Class_Id" => $class,
                                            "Email" => $email,
                                            "Code" => $staff_code
                                                ), "Staff_Id");
                                    }




                                    if ($editStaff) {

                                        echo $message = "<center><h4 style='color:blue'>data has been edited successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    $test_mode = (isset($_GET["mode"])) ? "&mode=view" : "";
                                    Redirect::go_to("index.php?page=add_staff&mode=" . $mode . "&class=" . $class_id);
                                }

                                if (Input::exists() && Input::get("send_policy") == "send_policy") {
                                    $staff_id = Input::get('staff_id');
                                    $email = Input::get('email');
                                    $code = Input::get('code');
                                    $count = 0;
                                    $staff_name = "";
                                    $system_email = DB::getInstance()->displayTableColumnValue("select Email from system_email where Status=1 and Type='$type'", 'Email');
                                    $system_email_password = DB::getInstance()->displayTableColumnValue("select Password from system_email where Status=1", 'Password');

                                    for ($i = 0; $i < sizeof($staff_id); $i++) {
                                        $queryDup = DB::getInstance()->checkRows("select * from survey_codes where Email='$email[$i]' and Status='1'");
                                        if (!$queryDup) {
                                            $staff_name .= DB::getInstance()->displayTableColumnValue("select Staff_Name from staff where Staff_Id='$staff_id[$i]' ", "Staff_Name");
                                            send_policy_Email($email[$i], $staff_name, $code[$i], $system_email, $system_email_password);
                                            DB::getInstance()->insert("policy_codes", array(
                                                "Code" => $code[$i],
                                                "Email" => $email[$i],
                                                "Staff_Id" => $staff_id[$i]
                                            ));
//
                                            $count++;
                                            $log = $_SESSION['hospital_staff_names'] . "  sent policy to :" . $staff_name;
                                            DB::getInstance()->logs($log);
                                        }
                                    }
                                    if ($count > 0) {
                                        $message = "Policy has been sent to " . $staff_name;
                                        echo "<h4 style='color:blue;'><center>" . $message . "</center></h4>";
                                    } else {
                                        echo "<h4 style='color:red;'><center>No Policy was sent</center></h4>";
                                    }
                                    Redirect::go_to("index.php?page=add_staff&mode=" . $mode . "&class=" . $class_id);
                                }
                                ?>

                                <div class="card card-topline-yellow">
                                    <div class="card-head">
                                        <center>   <span style="color:red;" id="result"></span></center>
                                        <header><?php echo $modez = ($mode == 'registered') ? '' : 'Last entered 10 '; ?>Student List</header>
                                    </div>
                                    <div class="card-body " id="bar-parent">
                                        <div class="col-md-12">
                                            <form method="post" action="index.php?page=<?php echo "add_staff" . '&mode=' . $mode . "&class=" . $class_id; ?>">
                                                <div class="form-group col-md-4">
                                                    <label>Class:</label>
                                                    <select name="class" class="select2" style="width: 100%" onchange="returnsubject(this.value, 'uploadedData');" required>
                                                        <option value="">Choose...</option>
                                                        <?php
                                                        $qstn_list = DB::getInstance()->querySample("select * from class ORDER BY Id");
                                                        foreach ($qstn_list as $qtn):
                                                            $selected = ($qtn->Id == $class_id) ? "selected" : "";
                                                            echo '<option value="' . $qtn->Id . '"' . $selected . '>' . $qtn->Class_Name . '</option>';
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>


                                                <div class="box-footer col-md-3">
                                                    <br/>
                                                    <button type="submit"  name="search" value="search" class="btn btn-success fa fa-search pull-right">search</button>
                                                </div>

                                            </form>
                                            <div class="form-group col-md-5 ">
                                                <a data-toggle='modal' class="btn btn-primary pull-right" href='#modal-form'><i class="fa fa-mail">Send Exam</i></a>
                                            </div>
                                        </div>
                                        <?php
                                        $queryStaff = 'SELECT * FROM staff WHERE Status=1 and Class_Id="' . $class_id . '" ORDER BY Staff_Id desc ' . $limit;
                                        if (DB::getInstance()->checkRows($queryStaff)) {
                                            ?>
                                            <?php
                                            if ($mode == 'register') {
                                                
                                            } else {
                                                ?>
                                                <?php
                                                if ((isset($_SESSION['hospital_role']) && ($_SESSION['hospital_role'] == "Human Resource")) && !isset($_SESSION['immergencepassword'])) {
                                                    
                                                } else {
                                                    ?>
                                                                                                                        <!--<a data-toggle='modal' class="btn btn-success pull-right" href='#modal-child_protection'><i class="fa fa-mail">Send exam</i></a>-->


                                                    <?php
                                                }
                                            }
                                            ?>

                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 1%;">#</th>
                                                        <th style="width: 4%;">RegNo.</th>
                                                        <th style="width: 25%;">Name</th>
                                                        <th style="width: 25%;">Email</th>
                                                        <th style="width: 25%;">Class</th>
                                                        <th style="width: 15%;">Photo</th>
                                                        <th style="width: 25%;"> 
                                                            <label class="btn btn-success btn-xs" for="selectall" id="selectControl" onclick="Check()">Click to Select All</label>

                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $data_got = DB::getInstance()->querySample($queryStaff);
                                                    $no = 1;
                                                    foreach ($data_got as $staffs) {
                                                        ?>
                                                        <tr> 
                                                            <td style="width: 1%;"><?php echo $no; ?></td>
                                                            <td style="width: 4%;"><?php echo $staffs->Code; ?></td>
                                                            <td style="width: 25%;"><?php echo $staffs->Staff_Name; ?></td>
                                                            <td style="width: 25%;"><?php echo $staffs->Email; ?></td>
                                                            <td style="width: 25%;"><?php echo DB::getInstance()->displayTableColumnValue("select Class_Name from class where Id='$staffs->Class_Id' ", "Class_Name") ?></td>
                                                            <td style="width: 15%;"><img class="img-circle" height="40px" width="40px" src="staff_image/<?php echo $staffs->Image; ?>" alt="<?php echo $staffs->Code; ?>"></td>
                                                            <td style="width: 25%;"><div class="btn-group xs">
                                                                    <button type="button" class="btn btn-success">Action</button>
                                                                    <button type="button" class="btn btn-success  dropdown-toggle" data-toggle="dropdown">
                                                                        <span class="caret"></span>
                                                                        <span class="sr-only">Toggle Dropdown</span>
                                                                    </button>
                                                                    <ul class="dropdown-menu" role="menu">

                                                                        <li><a  data-toggle="modal" data-target="#modal-<?php echo $staffs->Staff_Id; ?>">Edit</a></li>
                                                                        <?php
                                                                        if ((isset($_SESSION['hospital_role']) && ($_SESSION['hospital_role'] == "Human Resource" || $_SESSION['hospital_role'] == "Staff")) && !isset($_SESSION['immergencepassword'])) {
                                                                            
                                                                        } else {
                                                                            ?>
                                                                            <li><a href="index.php?page=<?php echo "add_staff" . '&action=delete&staff_id=' . $staffs->Staff_Id . '&mode=' . $mode . "&class=" . $class_id; ?>" onclick="return confirm('Are you sure you want to delete <?php echo $staffs->Staff_Name; ?>?');">Delete</a></li>
                                                                        <?php } ?> <li class="divider"></li>

                                                                    </ul>
                                                                </div>
                                                                <input type="checkbox" id="<?php echo $staffs->Staff_Id ?>"onchange="clicked('<?php echo $staffs->Staff_Id; ?>', '<?php echo $staffs->Staff_Name; ?>','<?php echo $staffs->Email; ?>');" value="<?php echo $staffs->Staff_Name.','.$staffs->Email; ?>" name="staffs[]">
                                                            </td>

                                                    <div class="modal fade" id="modal-<?php echo $staffs->Staff_Id; ?>">
                                                        <div class="modal-dialog">
                                                            <form role="form" action="index.php?page=<?php echo "add_staff" . '&mode=' . $mode . "&class=" . $class_id; ?>" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title">Edit <?php echo $staffs->Staff_Name; ?>'s Information</h4>
                                                                    </div> <div class="modal-body">
                                                                        <div id="file_div<?php echo $staffs->Staff_Id; ?>">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputFile">Staff Image</label>
                                                                                <input type="file" id="i_file<?php echo $staffs->Staff_Id; ?>" name="stuff_photo" value="<?php echo $staffs->Image; ?>" accept="image/*" onchange="readURL(this, '<?php echo $staffs->Staff_Id; ?>');">

                                                                                <img style="width:100px;" id="blah<?php echo $staffs->Staff_Id; ?>" src="staff_image/<?php echo $staffs->Image; ?>" class="user-image" alt="User Image">

                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>RegNo.</label>
                                                                            <input type="text" class="form-control" name="staff_code" value="<?php echo $staffs->Code; ?>" required>
                                                                            <input type="hidden" class="form-control" name="staff_id" value="<?php echo $staffs->Staff_Id; ?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Name</label>
                                                                            <input type="text" class="form-control" name="staff_name" value="<?php echo $staffs->Staff_Name; ?>" placeholder="Enter staff names" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Class:</label>
                                                                            <select name="class" class="select2" style="width: 100%" required>
                                                                                <option value="">Choose...</option>
                                                                                <?php
                                                                                $qstn_list = DB::getInstance()->querySample("select * from class ORDER BY Id");
                                                                                foreach ($qstn_list as $qtn):
                                                                                    $selected = ($staffs->Class_Id == $qtn->Id) ? "selected" : "";
                                                                                    echo '<option value="' . $qtn->Id . '" ' . $selected . '>' . $qtn->Class_Name . '</option>';
                                                                                endforeach;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Email</label>
                                                                            <input type="email" class="form-control" name="email" value="<?php echo $staffs->Email; ?>" placeholder="Enter student email" required>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="edit_staff" value="edit_staff" class="btn btn-primary">Save changes</button>
                                                                    </div>


                                                                </div>
                                                            </form>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>

                                                    </tr>

                                                    <?php
                                                    $no++;
                                                }
                                                ?>
                                                </tbody>

                                            </table>
                                            <?php
                                        } else {
                                            echo '<div class="col-md-12"><a class="alert alert-danger">No staff registered</a></div>';
                                        }
                                        ?>

                                        <div class="modal fade" id="modal-form">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Fill in this form and send Exam</h4>
                                                    </div> 
                                                      <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                                        <label >Subject:</label>
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                                        <select name="class" class="select2" id="subject_"style="width: 100%" required>
                                                                            <option value="">Choose...</option>
                                                                            <?php
                                                                            $qstn_list = DB::getInstance()->querySample("select * from subject where Class_Id='$class_id' and Status=1 ORDER BY Id");
                                                                            foreach ($qstn_list as $qtn):
                                                                                echo '<option value="' . $qtn->Id . '">' . $qtn->Subject_Name . '</option>';
                                                                            endforeach;
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                </div>

                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="col-lg-4 col-md-4 col-sm-4">Staff</div>
                                                                    <div class="col-lg-8 col-md-8 col-sm-8">email</div>

                                                                </div>

                                                                <div class="col-lg-12 col-md-12 col-sm-12" id="id_data">

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="send_survey" data-dismiss="modal" value="send_survey"  class="btn btn-primary" onclick="send_exam();">Send Exam</button>
                                                        </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        <!-- /.box-body -->
                                    </div>
                                </div>
                                <!-- /.col (right) -->
                            </div>
                            <!-- /.row -->
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
        <!-- start js include path -->

        <?php include_once 'includes/footer_js.php'; ?>
        <!-- end js include path -->
    </body>

</html>