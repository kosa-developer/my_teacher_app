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
                if (isset($_GET['mode'])) {
                    echo $mode = $_GET['mode'];
                    $hidden = "";
                    $hidden2 = "";
                    if ($mode == 'register') {

                        $hidden = "";
                        $hidden2 = "hidden";
                        $course_width = "col-md-7";
                        $limit = "limit 10";
                    } else {
                        $hidden2 = "";
                        $hidden = "hidden";
                        $course_width = "col-md-12";
                        $limit = "";
                    }
                }
                ?>
                <!-- end sidebar menu -->
                <!-- start page content -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">Course unit</div>
                                </div>
                                <div class="actions panel_actions pull-right">
                                    <a class="btn btn-primary" href="index.php?page=<?php echo "course_unit" . '&mode=' . $modez = ($mode == 'registered') ? 'register' : 'registered'; ?>"><i class="fa fa-eye"></i><?php echo $modez = ($mode == 'registered') ? 'Register' : 'Registered'; ?> course_unit(s)</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12" <?php echo $hidden; ?>>
                                <?php
                                if (Input::exists() && Input::get("submit_course_unit") == "submit_course_unit") {
                                    $course = Input::get('course');
                                    $course_unit = Input::get('course_unit');
                                    $duplicate = 0;
                                    $submited = 0;
                                    for ($i = 0; $i < sizeof($course_unit); $i++) {
                                        $queryDup = DB::getInstance()->checkRows("select * from course_unit where Course_unit='$course_unit[$i]' and Course_Id='$course'");
                                        if (!$queryDup) {
                                            DB::getInstance()->insert("course_unit", array(
                                                "Course_unit" => $course_unit[$i],
                                                "Course_Id" => $course));
                                            $submited++;
                                        } else {
                                            $duplicate++;
                                        }
                                    }
                                    if ($submited > 0) {
                                        echo '<div class="alert alert-success">' . $submited . ' Course_unit(s) submitted successfully</div>';
                                    }
                                    if ($duplicate > 0) {
                                        echo '<div class="alert alert-warning">' . $duplicate . ' Course_units already exisits</div>';
                                    }
                                    Redirect::go_to("index.php?page=course_unit&mode=" . $mode);
                                }
                                ?>
                                <form role="form" action="index.php?page=<?php echo "course_unit" . '&mode=' . $mode; ?>"method="POST" enctype="multipart/form-data">
                                    <div class="card card-topline-yellow">
                                        <div class="card-head">
                                            <header>Register course unit</header>
                                        </div>
                                        <div class="card-body col-md-6" id="bar-parent">
                                            <div class="form-group">
                                                <label>Course:</label>
                                                <select name="course" class="select2" style="width: 100%" required>
                                                    <option value="">Choose...</option>
                                                    <?php
                                                    $qstn_list = DB::getInstance()->querySample("select * from courses ORDER BY Id");
                                                    foreach ($qstn_list as $qtn):
                                                        echo '<option value="' . $qtn->Id . '">' . $qtn->Course_Name . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div id="Course_unit" >
                                                <button type="button" class="btn btn-success btn-xs pull-right" id="add_more" onclick="add_element();">Add more course_units</button>

                                                <div class="form-group" id="add_element">

                                                    <div class="form-group ">
                                                        <label>course unit(es)</label>
                                                        <input type="text" name="course_unit[]" required class="form-control"/>
                                                    </div>

                                                    <br/> </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit"  name="submit_course_unit" value="submit_course_unit" class="btn btn-primary pull-right">Submit</button>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>

                            </div>
                            <!-- /.col (left) -->
                            <div  class="col-md-12" <?php echo $hidden2; ?>>
                                <?php
                                if (isset($_GET['action']) && $_GET['action'] == 'delete') {

                                    $course_unit_id = $_GET['Id'];
                                    $query = DB::getInstance()->query("UPDATE course_unit SET Status=0 WHERE Id='$course_unit_id'");
                                    if ($query) {

                                        $Course_unit = DB::getInstance()->displayTableColumnValue("select Course_unit from course_unit where Id='$course_unit_id' ", "Course_unit");

                                        echo $message = "<center><h4 style='color:red'>data has been deleted successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=course_unit&mode=" . $mode);
                                }
                                if (Input::exists() && Input::get("edit_course_unit") == "edit_course_unit") {
                                    $Id = Input::get('Id');
                                    $Course_unit = Input::get('Course_unit');
                                    $course_id=Input::get('course');
                                    
                                    $editCourse_unit = DB::getInstance()->update("course_unit", $Id, array(
                                        "Course_unit" => $Course_unit,
                                        "Course_Id" => $course_id), "Id");


                                    if ($editCourse_unit) {
                                       
                                        echo $message = "<center><h4 style='color:blue'>Data has been edited successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=course_unit&mode=" . $mode);
                                }
                                ?>

                                <div class="card card-topline-yellow">
                                    <div class="card-head">
                                        <header><?php echo $modez = ($mode == 'registered') ? '' : 'Last entered 10 '; ?>Course_units List</header>
                                    </div>
                                    <div class="card-body " id="bar-parent">
                                        <?php
                                        $queryCourse_unit = 'SELECT * FROM course_unit WHERE Status=1 ORDER BY Course_Id' . $limit;
                                        if (DB::getInstance()->checkRows($queryCourse_unit)) {
                                            ?>
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 1%;">#</th>
                                                        <th >Course</th>
                                                        <th >Course unit</th>
                                                        <th style="width: 20%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $data_got = DB::getInstance()->querySample($queryCourse_unit);
                                                    $no = 1;
                                                    foreach ($data_got as $Course_unitx) {
                                                        ?>
                                                        <tr> 
                                                            <td style="width: 1%;"><?php echo $no; ?></td>
                                                            <td><?php echo DB::getInstance()->displayTableColumnValue("select Course_Name from courses where Id='$Course_unitx->Course_Id' ", "Course_Name") ?></td>
                                                            <td><?php echo $Course_unitx->Course_unit; ?></td>
                                                            <td style="width: 20%;">
                                                                <div class="btn-group xs">
                                                                    <button type="button" class="btn btn-success">Action</button>
                                                                    <button type="button" class="btn btn-success  dropdown-toggle" data-toggle="dropdown">
                                                                        <span class="caret"></span>
                                                                        <span class="sr-only">Toggle Dropdown</span>
                                                                    </button>
                                                                    <ul class="dropdown-menu" role="menu">

                                                                        <li><a  data-toggle="modal" data-target="#modal-<?php echo $Course_unitx->Id; ?>">Edit</a></li>
                                                                        <li><a href="index.php?page=<?php echo "course_unit" . '&action=delete&Id=' . $Course_unitx->Id . '&mode=' . $mode; ?>" onclick="return confirm('Are you sure you want to delete <?php echo $Course_unitx->Course_unit; ?>?');">Delete</a></li>
                                                                        <li class="divider"></li>

                                                                    </ul>
                                                                </div>

                                                            </td>

                                                    <div class="modal fade" id="modal-<?php echo $Course_unitx->Id; ?>">
                                                        <div class="modal-dialog">
                                                            <form role="form" action="index.php?page=<?php echo"course_unit" . '&mode=' . $mode; ?>" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span></button>

                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="Id" value="<?php echo $Course_unitx->Id ?>">
                                                                        <div class="form-group">
                                                                            <label>Class:</label>
                                                                            <select name="course" class="select2" style="width: 100%" required>
                                                                                <option value="">Choose...</option>
                                                                                <?php
                                                                                $qstn_list = DB::getInstance()->querySample("select * from courses ORDER BY Id");
                                                                                foreach ($qstn_list as $qtn):
                                                                                    $selected=($Course_unitx->Course_Id==$qtn->Id)?"selected":"";
                                                                                    echo '<option value="' . $qtn->Id . '" '.$selected.'>' . $qtn->Course_Name . '</option>';
                                                                                endforeach;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Course_unit(s)</label>
                                                                            <input type="text" name="Course_unit"  class="form-control" value="<?php echo $Course_unitx->Course_unit ?>" required/>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="edit_course_unit" value="edit_course_unit" class="btn btn-primary">Save changes</button>
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
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th>Class</th>
                                                        <th>Course unit</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                            <?php
                                        } else {
                                            echo '<div class="alert alert-danger">No course_unit registered</div>';
                                        }
                                        ?>


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
        <script>
            function add_element() {
                var row_ids = Math.round(Math.random( ) * 300000000);
                document.getElementById('add_element').insertAdjacentHTML('beforeend',
                        '<div  id="' + row_ids + '">\n\
     <input type="text" name="course_unit[]" rows="2" class="form-control" required/> \n\
 <button type="button" value="' + row_ids + '" class="btn btn-danger btn-xs pull-right" onclick="delete_item(this.value);">\n\
<i class ="fa fa-times"></i></button> </div>');

            }
            function delete_item(element_id) {
                $('#' + element_id).html('');
            }

        </script>
        <?php include_once 'includes/footer_js.php'; ?>
        <!-- end js include path -->
    </body>

</html>