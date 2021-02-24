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
                                    <div class="page-title">Question(s)</div>
                                </div>
                                <div class="actions panel_actions pull-right">
                                    <a class="btn btn-primary" href="index.php?page=<?php echo "policy_questions" . '&mode=' . $modez = ($mode == 'registered') ? 'register' : 'registered'; ?>"><i class="fa fa-eye"></i><?php echo $modez = ($mode == 'registered') ? 'Register' : 'Registered'; ?> Question(s)</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12" <?php echo $hidden; ?>>
                                <?php
                                if (Input::exists() && Input::get("submit_question") == "submit_question") {
                                    $question = Input::get('question');
                                    $marks = Input::get('marks');
                                    $choice = Input::get('choice');
                                    $subject = Input::get('subject');
                                    $exam = Input::get('exam');
                                    $hours = Input::get('hours');
                                    $minutes = Input::get('minutes');
                                    $timing = $hours . ":" . $minutes;
                                    $exam_insert = DB::getInstance()->insert("exam", array(
                                        "Exam_Name" => $exam,
                                        "Duration" => $timing,
                                        "Status" => 1,
                                        "Subject_Id" => $subject));

                                    $duplicate = 0;
                                    $submited = 0;
                                    if ($exam_insert) {
                                        $exam_id = DB::getInstance()->displayTableColumnValue("select Id from exam where Exam_Name='$exam' and Subject_Id='$subject'", "Id");
                                        if ($exam_id != null && $exam_id != "") {
                                            for ($i = 0; $i < sizeof($question); $i++) {
                                                $queryDup = DB::getInstance()->checkRows("select * from policy_questions where Question='$question[$i]' and Exam_Id='$exam_id'");
                                                if (!$queryDup) {
                                                    DB::getInstance()->insert("policy_questions", array(
                                                        "Question" => $question[$i],
                                                        "Choice" => $choice[$i],
                                                        "Exam_Id" => $exam_id,
                                                        "Marks" => $marks[$i]));
                                                    $submited++;
                                                    $log = $_SESSION['hospital_staff_names'] . "  registered a new question :";
                                                    DB::getInstance()->logs($log);
                                                } else {
                                                    $duplicate++;
                                                }
                                            }
                                        }
                                    }
                                    if ($submited > 0) {
                                        echo '<div class="alert alert-success">' . $submited . ' question(s) submitted successfully</div>';
                                    }
                                    if ($duplicate > 0) {
                                        echo '<div class="alert alert-warning">' . $duplicate . ' questions already exisits</div>';
                                    }
                                    Redirect::go_to("index.php?page=policy_questions&mode=" . $mode);
                                }
                                ?>
                                <form role="form" action="index.php?page=<?php echo "policy_questions" . '&mode=' . $mode; ?>"method="POST" enctype="multipart/form-data">
                                    <div class="card card-topline-yellow">

                                        <div class="card-head">
                                            <header>Register Question</header>

                                        </div>
                                        <div class="card-body " id="bar-parent">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
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

                                                <div class="col-md-3" id="selectedData">

                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Exam name:</label> 
                                                    <input class="form-control" name="exam" required>
                                                </div>
                                                <div class="form-group col-md-3">

                                                    <div>
                                                        <div class="col-md-6"><label>Hours:</label> <select class="form-control" name="hours" required><?php
                                                                for ($i = 0; $i <= 12; $i++) {
                                                                    $zero = ($i < 10) ? "0" : "";
                                                                    echo '<option value="' . $zero . '' . $i . '">' . $zero . '' . $i . '</option>';
                                                                }
                                                                ?></select></div> 
                                                        <div class="col-md-6"><label>Minutes:</label><select class="form-control" name="minutes" required><?php
                                                                for ($i = 0; $i <= 59; $i++) {
                                                                    $zero = ($i < 10) ? "0" : "";
                                                                    echo '<option value="' . $zero . '' . $i . '">' . $zero . '' . $i . '</option>';
                                                                }
                                                                ?></select></div>

                                                    </div>




                                                </div>

                                            </div>
                                            <div id="question"><button type="button" class="btn btn-success btn-xs pull-right" id="add_more" onclick="add_element();">Add more</button>
                                                <div id="add_element" > 
                                                    <div class="form-group col-md-7" >
                                                        <label>question(s)</label>
                                                        <textarea name="question[]" rows="2" class="form-control" required></textarea>

                                                    </div>
                                                    <div class="form-group col-md-2" id="add_element">
                                                        <label>Choice</label>
                                                        <input type="number" step="0" name="choice[]" class="form-control" required/>
                                                    </div>
                                                    <div class="form-group col-md-2" id="add_element">
                                                        <label>Marks @ Answer</label>
                                                        <input type="number" step="0" name="marks[]" class="form-control" required/>
                                                    </div>
                                                    <br/> 
                                                </div>
                                                <button type="button" class="btn btn-success btn-xs pull-right" id="add_more" onclick="add_element();">Add more</button>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit"  name="submit_question" value="submit_question" class="btn btn-primary pull-right">Submit</button>
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

                                    $quetion_id = $_GET['Question_Id'];
                                    $query = DB::getInstance()->query("UPDATE policy_questions SET Status=0 WHERE Question_Id='$quetion_id'");
                                    if ($query) {

                                        $question = DB::getInstance()->displayTableColumnValue("select Question from policy_questions where Question_Id='$quetion_id' ", "Question");
                                        $log = $_SESSION['hospital_staff_names'] . "  deleted " . $question . "s information";
                                        DB::getInstance()->logs($log);
                                        echo $message = "<center><h4 style='color:red'>data has been deleted successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=policy_questions&mode=" . $mode);
                                }
                                if (Input::exists() && Input::get("edit_staff") == "edit_staff") {
                                    $Question_Id = Input::get('question_id');
                                    $subject = Input::get('subject');
                                    $question = Input::get('question');
                                    $question_z = DB::getInstance()->displayTableColumnValue("select Question from policy_questions where Question_Id='$Question_Id' ", "Question");

                                    $editquestion = DB::getInstance()->update("policy_questions", $Question_Id, array(
                                        "Question" => $question), "Question_Id");


                                    if ($editquestion) {
                                        $log = $_SESSION['hospital_staff_names'] . "  edited " . $question_z . " to " . $question;
                                        DB::getInstance()->logs($log);
                                        echo $message = "<center><h4 style='color:blue'>data has been edited successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=policy_questions&mode=" . $mode . "&subject=" . $subject);
                                }
                                ?>

                                <div class="card card-topline-yellow">
                                    <div class="card-head">
                                        <header><?php echo $modez = ($mode == 'registered') ? '' : 'Last entered 10 '; ?>questions List</header>
                                    </div>
                                    <div class="card-body " id="bar-parent">
                                        <div class="col-md-12">
                                            <form method="post" action="index.php?page=<?php echo "policy_questions" . '&mode=' . $mode; ?>">
                                                <div class="form-group col-md-3">
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

                                                <div class="col-md-3" id="uploadedData">

                                                </div>

                                                <div class="col-md-3" id="exam_data">

                                                </div>

                                                <div class="box-footer col-md-3">
                                                    <br/>
                                                    <button type="submit"  name="search" value="search" class="btn btn-success fa fa-search pull-right">search</button>
                                                </div>
                                            </form>

                                        </div>
                                        <?php
                                        if ((Input::exists() && Input::get("exam")) || isset($_GET['exam'])) {
                                            $exam = Input::get("exam");
                                            $queryquestion = 'SELECT * FROM policy_questions WHERE Status=1 and Exam_Id="' . $exam . '" ORDER BY Question_Id' . $limit;
                                            if (DB::getInstance()->checkRows($queryquestion)) {
                                                ?>
                                         <div class="card-head">
                                            <header>Exam:  <?php echo DB::getInstance()->displayTableColumnValue("select Exam_Name from exam where Id='$exam' ", "Exam_Name");?>
                                                <br/> <br/>Duration: <?php echo DB::getInstance()->displayTableColumnValue("select Duration from exam where Id='$exam' ", "Duration");?> hrs</header>

                                        </div>
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 1%;">#</th>
                                                            <th >Question</th>
                                                            <th >Marks @ Qtn</th>
                                                            <th style="width: 20%;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $data_got = DB::getInstance()->querySample($queryquestion);
                                                        $no = 1;
                                                        foreach ($data_got as $questionx) {
                                                            ?>
                                                            <tr> 
                                                                <td style="width: 1%;"><?php echo $no; ?></td>
                                                                <td><?php echo $questionx->Question; ?></td>
                                                                <td><?php echo $questionx->Marks; ?></td>
                                                                <td style="width: 20%;">
                                                                    <div class="btn-group xs">
                                                                        <button type="button" class="btn btn-success">Action</button>
                                                                        <button type="button" class="btn btn-success  dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="caret"></span>
                                                                            <span class="sr-only">Toggle Dropdown</span>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">

                                                                            <li><a  data-toggle="modal" data-target="#modal-<?php echo $questionx->Question_Id; ?>">Edit</a></li>
                                                                            <li><a href="index.php?page=<?php echo "policy_questions" . '&action=delete&Question_Id=' . $questionx->Question_Id . '&mode=' . $mode; ?>" onclick="return confirm('Are you sure you want to delete <?php echo $questionx->Question; ?>?');">Delete</a></li>
                                                                            <li class="divider"></li>

                                                                        </ul>
                                                                    </div>

                                                                </td>

                                                        <div class="modal fade" id="modal-<?php echo $questionx->Question_Id; ?>">
                                                            <div class="modal-dialog">
                                                                <form role="form" action="index.php?page=<?php echo "policy_questions" . '&mode=' . $mode . '&subject=' . $subject; ?>" method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>

                                                                        </div> <div class="modal-body">
                                                                            <input type="hidden" name="question_id" value="<?php echo $questionx->Question_Id ?>">

                                                                            <div class="form-group">
                                                                                <label>question(s)</label>
                                                                                <textarea name="question" rows="2" class="form-control" required><?php echo $questionx->Question ?></textarea>
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
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>Question</th>
                                                            <th>Marks @ Qtn</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>

                                                </table>
                                                <?php
                                            } else {
                                                echo '<div class="alert alert-danger">No Question registered</div>';
                                            }
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
                var row_ids = Math.round(Math.random() * 300000000);
                document.getElementById('add_element').insertAdjacentHTML('beforeend',
                        '<div id="' + row_ids + '"><div class="form-group col-md-7">\n\
     <textarea name="question[]" rows="2" class="form-control" required></textarea> \n\
 </div>\n\
 <div class="form-group col-md-2" >\n\
    <label>Choice</label>\n\
    <input type="number" step="0" name="choice[]" class="form-control" required/>\n\
</div>\n\
    <div class="form-group col-md-2" id="add_element">\n\
            <label>Marks @ Answer</label>\n\
            <input type="number" step="0" name="marks[]" class="form-control" required/>\n\
                        <button type="button" value="' + row_ids + '" class="btn btn-danger btn-xs pull-right" onclick="delete_item(this.value);">\n\
<i class ="fa fa-times"></i></button></div></div>');

            }
            function delete_item(element_id) {
                $('#' + element_id).html('');
            }

        </script>
        <?php include_once 'includes/footer_js.php'; ?>
        <!-- end js include path -->
    </body>

</html>