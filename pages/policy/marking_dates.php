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
                        $class_width = "col-md-7";
                        $limit = "limit 10";
                    } else {
                        $hidden2 = "";
                        $hidden = "hidden";
                        $class_width = "col-md-12";
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
                                    <div class="page-title">Final submission dates</div>
                                </div>
                                <div class="actions panel_actions pull-right">
                                    <a class="btn btn-primary" href="index.php?page=<?php echo "marking_dates" . '&mode=' . $modez = ($mode == 'registered') ? 'register' : 'registered'; ?>"><i class="fa fa-eye"></i><?php echo $modez = ($mode == 'registered') ? 'Register' : 'Registered'; ?> deadline(s)</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12" <?php echo $hidden; ?>>
                                <?php
                                if (Input::exists() && Input::get("submit_deadline") == "submit_deadline") {
                                    $deadline = Input::get('deadline');
                                    $exam = Input::get('exam');
                                    $duplicate = 0;
                                    $submited = 0;
                                    $queryDup = DB::getInstance()->checkRows("select * from marking_schedule where Exam_Id='$exam'");
                                    if (!$queryDup) {
                                        DB::getInstance()->insert("marking_schedule", array(
                                            "Date" => $deadline,
                                            "Exam_Id" => $exam));
                                        echo '<div class="alert alert-success">deadline recorded successfully</div>';
                                    } else {
                                        echo '<div class="alert alert-success">deadline already exisits</div>';
                                    }

                                    Redirect::go_to("index.php?page=marking_dates&mode=" . $mode);
                                }
                                ?>
                                <form role="form" action="index.php?page=<?php echo "marking_dates" . '&mode=' . $mode; ?>"method="POST" enctype="multipart/form-data">
                                    <div class="card card-topline-yellow">

                                        <div class="card-head">
                                            <header>Set Deadline</header>

                                        </div>
                                        <div class="card-body " id="bar-parent">

                                            <div id="add_element" > 
                                                <div class="form-group col-md-2">
                                                    <label>Class:</label>
                                                    <select name="class" class="select2" style="width: 100%" onchange="returnsubject(this.value, 'selectedData');" required>
                                                        <option value="">Choose...</option>
                                                        <?php
                                                        $qstn_list = DB::getInstance()->querySample("select * from class ORDER BY Id");
                                                        foreach ($qstn_list as $qtn):
                                                            echo '<option value="' . $qtn->Id . '">' . $qtn->Class_Name . '</option>';
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-2" id="selectedData">

                                                </div>
                                                 <div class="col-md-2" id="exam_data">

                                                </div>
                                                <div class="col-md-3"
                                                     <div class="form-group" id="add_element">
                                                        <label>Date</label>
                                                        <input type="date" step="0" name="deadline" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="box-footer">
                                                    <br/>
                                                    <button type="submit"  name="submit_deadline" value="submit_deadline" class="btn btn-primary pull-right">Submit</button>
                                                </div>
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

                                    $deadline_id = $_GET['Id'];
                                    $query = DB::getInstance()->query("UPDATE marking_schedule SET Status=0 WHERE Id='$deadline_id'");
                                    if ($query) {

                                        $Date = DB::getInstance()->displayTableColumnValue("select Date from marking_schedule where Id='$deadline_id' ", "Date");
                                        
                                        echo $message = "<center><h4 style='color:red'>data has been deleted successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=marking_dates&mode=" . $mode);
                                }
                                if (Input::exists() && Input::get("edit_deadline") == "edit_deadline") {
                                    $Id = Input::get('Id');
                                    $Date = Input::get('date');
                                    $Date_z = DB::getInstance()->displayTableColumnValue("select Date from marking_schedule where Id='$Id' ", "Date");

                                    $editDate = DB::getInstance()->update("marking_schedule", $Id, array(
                                        "Date" => $Date), "Id");


                                    if ($editDate) {
                                       
                                        echo $message = "<center><h4 style='color:blue'>data has been edited successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
//                                    Redirect::go_to("index.php?page=marking_dates&mode=" . $mode . "&subject=" . $subject);
                                }
                                ?>

                                <div class="card card-topline-yellow">
                                    <div class="card-head">
                                        <header><?php echo $modez = ($mode == 'registered') ? '' : 'Last entered 10 '; ?>Dates List</header>
                                    </div>
                                    <div class="card-body " id="bar-parent">

                                        <?php
                                        $querydeadline = 'SELECT * FROM marking_schedule WHERE Status=1 ORDER BY Id';
                                        if (DB::getInstance()->checkRows($querydeadline)) {
                                            ?>
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 1%;">#</th>
                                                        <th >Class</th>
                                                        <th >Subject</th>
                                                        <th >deadline</th>
                                                        <th style="width: 20%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $data_got = DB::getInstance()->querySample($querydeadline);
                                                    $no = 1;
                                                    foreach ($data_got as $deadline) {
                                                     
                                                        ?>
                                                        <tr> 
                                                            <td style="width: 1%;"><?php echo $no; ?></td>
                                                            <td><?php echo DB::getInstance()->displayTableColumnValue("select Class_Name from class,subject,exam where subject.Class_Id=class.Id and exam.Subject_Id=subject.Id and exam.Id='$deadline->Exam_Id'", "Class_Name"); ?> </td>
                                                            <td><?php echo DB::getInstance()->displayTableColumnValue("select Subject_Name from subject,exam where exam.Subject_Id=subject.Id and exam.Id='$deadline->Exam_Id'", "Subject_Name"); ?>  <?php echo DB::getInstance()->displayTableColumnValue("select Exam_Name from exam where Id='$deadline->Exam_Id'", "Exam_Name"); ?></td>
                                                            <td><?php echo $deadline->Date; ?></td>
                                                            <td style="width: 20%;">
                                                                <div class="btn-group xs">
                                                                    <button type="button" class="btn btn-success">Action</button>
                                                                    <button type="button" class="btn btn-success  dropdown-toggle" data-toggle="dropdown">
                                                                        <span class="caret"></span>
                                                                        <span class="sr-only">Toggle Dropdown</span>
                                                                    </button>
                                                                    <ul class="dropdown-menu" role="menu">

                                                                        <li><a  data-toggle="modal" data-target="#modal-<?php echo $deadline->Id; ?>">Edit</a></li>
                                                                        <li><a href="index.php?page=<?php echo "marking_dates" . '&action=delete&Id=' . $deadline->Id . '&mode=' . $mode; ?>" onclick="return confirm('Are you sure you want to delete <?php echo $deadline->Date; ?>?');">Delete</a></li>
                                                                        <li class="divider"></li>

                                                                    </ul>
                                                                </div>

                                                            </td>

                                                    <div class="modal fade" id="modal-<?php echo $deadline->Id; ?>">
                                                        <div class="modal-dialog">
                                                            <form role="form" action="index.php?page=<?php echo "marking_dates" . '&mode=' . $mode . '&subject=' . $subject; ?>" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span></button>

                                                                    </div> <div class="modal-body">
                                                                        <input type="hidden" name="Id" value="<?php echo $deadline->Id ?>">

                                                                        <div class="form-group">
                                                                            <label>Date</label>
                                                                            <input type="date" name="date" value="<?php echo $deadline->Date ?>" class="form-control" required/>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="edit_deadline" value="edit_deadline" class="btn btn-primary">Save changes</button>
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
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                            <?php
                                        } else {
                                            echo '<div class="alert alert-danger">No Date Set</div>';
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

        <?php include_once 'includes/footer_js.php'; ?>
        <!-- end js include path -->
    </body>

</html>