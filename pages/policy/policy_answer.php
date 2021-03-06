<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->

    <head>
        <?php include_once 'includes/header_css.php'; ?>
        <style type="text/css">
            .modal-lg {
                max-width: 60%;
            }
        </style>
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
                                    <div class="page-title">Marking Guide</div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col (left) -->
                            <div  class="col-md-12" <?php echo $hidden2; ?>>
                                <?php
                                $exam = "";
                                if (isset($_GET['exam'])) {
                                    $exam = $_GET['exam'];
                                }
                                if (isset($_GET['action']) && $_GET['action'] == 'delete') {

                                    $quetion_id = $_GET['question_id'];
                                    $query = DB::getInstance()->query("UPDATE policy_answers SET Status=0 WHERE Question_Id='$quetion_id'");
                                    if ($query) {
                                        echo $message = "<center><h4 style='color:red'>data has been deleted successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=policy_answer&mode=" . $mode . "&exam=" . $exam);
                                }

                                if (Input::exists() && Input::get("submit_answer") == "submit_answer") {
                                    $question = Input::get('question');
                                    $answer = Input::get('answer');
                                    $validity = Input::get('validity');
                                    $duplicate = 0;
                                    $submited = 0;
                                    for ($i = 0; $i < sizeof($answer); $i++) {
                                        $queryDup = DB::getInstance()->checkRows("select * from policy_answers where Answer='$answer[$i]' AND Question_Id='$question'");
                                        if (!$queryDup) {
                                            DB::getInstance()->insert("policy_answers", array(
                                                "Question_Id" => $question,
                                                "Answer" => $answer[$i],
                                                "Correct" => $validity[$i]));
                                            $submited++;
                                            $log = $_SESSION['hospital_staff_names'] . "  registered a new child protection answer :";
                                            DB::getInstance()->logs($log);
                                        } else {
                                            DB::getInstance()->query("UPDATE policy_answers SET Status=1,Correct='$validity[$i]' where Answer='$answer[$i]' AND Question_Id='$question' ");
                                            $duplicate++;
                                        }
                                    }
                                    if ($submited > 0) {
                                        $qtnz = DB::getInstance()->displayTableColumnValue("select Question from policy_questions where Question_Id='$question'", "Question");
                                        echo '<div class="alert alert-success">' . $submited . ' Answers to ' . $qtnz . ' submitted successfully</div>';
                                    }
                                    if ($duplicate > 0) {
                                        echo '<div class="alert alert-warning">' . $duplicate . ' answers already exisits but now active</div>';
                                    }
                                    Redirect::go_to("index.php?page=policy_answer&mode=" . $mode . "&exam=" . $exam);
                                }
                                ?>

                                <div class="card card-topline-yellow">
                                    <div class="card-head">
                                        <header><?php echo $modez = ($mode == 'registered') ? '' : 'Last entered 10 '; ?>questions List</header>
                                    </div>
                                    <div class="card-body " id="bar-parent">
                                        <div class="col-md-10">
                                            <form method="post" action="index.php?page=<?php echo "policy_answer" . '&mode=' . $mode; ?>">
                                                <div class="form-group col-md-3">
                                                    <label>Class:</label>
                                                    <select name="class" class="select2" style="width: 100%" onchange="returnsubject_(this.value, 'uploadedData');" required>
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
                                                <div class="col-md-3" id="exam_data_">

                                                </div>


                                                <div class="box-footer col-md-3">
                                                    <br/>
                                                    <button type="submit"  name="search" value="search" class="btn btn-success fa fa-search pull-right">search</button>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="col-md-12">
                                            <?php
                                            if ((Input::exists() && Input::get("exam")) || isset($_GET['exam'])) {
                                                $exam = Input::get("exam");
                                                $subject = Input::get("subject");
                                                $class = Input::get("class");
                                                $queryquestion = 'SELECT * FROM policy_questions WHERE Status=1 and Exam_Id="' . $exam . '" ORDER BY Question_Id' . $limit;
                                                if (DB::getInstance()->checkRows($queryquestion)) {
                                                    ?>
                                                    <form target="_blank"action="index.php?page=<?php echo "results" . "&type=download_marking_guide&exam=" . $exam . "&subject=" . $subject . "&class=" . $class; ?>" method="POST">
                                                        <button type="submit"class="btn btn-primary fa fa-print pull-right">Print</button>

                                                    </form>  
                                                    <div class="card-head">
                                                        <header>Exam:  <?php echo DB::getInstance()->displayTableColumnValue("select Exam_Name from exam where Id='$exam' ", "Exam_Name"); ?>
                                                            <br/> <br/>Duration: <?php echo DB::getInstance()->displayTableColumnValue("select Duration from exam where Id='$exam' ", "Duration"); ?> hrs</header>

                                                    </div>
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 1%;">#</th>
                                                                <th >Question</th>
                                                                <th >Marks @qtn</th>
                                                                <th >Answers</th>
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
                                                                    <td><?php
                                                                        $data_answer = DB::getInstance()->querySample("select * from policy_answers where Question_Id='$questionx->Question_Id' and status=1 ");
                                                                        $count_answer = 1;
                                                                        foreach ($data_answer as $answerx) {
                                                                            $alphabet = ($count_answer == 1) ? "a" : (($count_answer == 2) ? "b" : (($count_answer == 3) ? "c" : (($count_answer == 4) ? "d" : (($count_answer == 5) ? "e" : (($count_answer == 6) ? "f" : "g")))));

                                                                            $colorz = ($answerx->Correct == 1) ? 'blue' : 'red';
                                                                            echo "<strong>" . $alphabet . ".</strong> " . $answerx->Answer . "<a style='" . $colorz . "'>(" . $correct = ($answerx->Correct == 1) ? "correct" : "wrong";
                                                                            echo ").</a> <br/><br/>";
                                                                            $count_answer++;
                                                                        }
                                                                        if (DB::getInstance()->checkRows("select * from policy_answers where Question_Id='$questionx->Question_Id' and status=1")) {}else{
                                                                        ?><a data-toggle="modal" data-target="#modal-<?php echo $questionx->Question_Id; ?>" class="btn-success btn-xs pull-right" ><i class="fa fa-plus"></i></a>
                                                                        <?php }?>
                                                                    </td>
                                                                    <td style="width: 20%;">
                                                                        <div class="btn-group xs">
                                                                            <button type="button" class="btn btn-success">Action</button>
                                                                            <button type="button" class="btn btn-success  dropdown-toggle" data-toggle="dropdown">
                                                                                <span class="caret"></span>
                                                                                <span class="sr-only">Toggle Dropdown</span>
                                                                            </button>
                                                                            <ul class="dropdown-menu" role="menu">

                                                                                <li><a href="index.php?page=<?php echo "policy_answer" . '&action=delete&question_id=' . $questionx->Question_Id . '&mode=' . $mode . '&exam=' . $exam; ?>" onclick="return confirm('Are you sure you want to delete <?php echo $questionx->Question; ?>?');">Delete</a></li>
                                                                                <li class="divider"></li>

                                                                            </ul>
                                                                        </div>
                                                                        <div  class="modal fade" id="modal-<?php echo $questionx->Question_Id; ?>">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <form role="form" action="index.php?page=<?php echo 'policy_answer' . '&mode=' . $mode . '&exam=' . $exam; ?>" method="POST" enctype="multipart/form-data">

                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span></button>
                                                                                            <label>Register answers for<span style="color: #002a80;"> <?php echo $questionx->Question ?> </span></label>

                                                                                        </div> 
                                                                                        <div class="modal-body">
                                                                                            <input type="hidden" name="question" value="<?php echo $questionx->Question_Id ?>">

                                                                                            <div >
                                                                                                <button type="button" class="btn btn-success btn-xs pull-right"  onclick="add_element('<?php echo $questionx->Question_Id ?>');">Add more</button>
                                                                                                <div id="add_element<?php echo $questionx->Question_Id ?>" > 
                                                                                                    <div class="form-group col-md-10" >
                                                                                                        <label>Answer(s)</label>
                                                                                                        <textarea name="answer[]" rows="2" class="form-control" required></textarea>

                                                                                                    </div>
                                                                                                    <div class="form-group col-md-2" >
                                                                                                        <select name="validity[]" class="select2" style="width: 100%" required>
                                                                                                            <option value="0">Wrong</option> 
                                                                                                            <option value="1">Correct</option> 
                                                                                                        </select>

                                                                                                    </div>

                                                                                                </div>
                                                                                                <br/> 
                                                                                                <button type="button" class="btn btn-success btn-xs pull-right"  onclick="add_element('<?php echo $questionx->Question_Id ?>');">Add more</button>


                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                            <button type="submit"  name="submit_answer" value="submit_answer" class="btn btn-primary">Save changes</button>
                                                                                        </div>
                                                                                    </form>

                                                                                </div>

                                                                            </div>
                                                                            <!-- /.modal-dialog -->
                                                                        </div>
                                                                    </td>



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
                                                                <th>Answers</th>
                                                                <th></th>
                                                            </tr>
                                                        </tfoot>

                                                    </table>
                                                    <?php
                                                } else {
                                                    echo '<div class="alert alert-danger">No Question registered</div>';
                                                }
                                            } else {
                                                echo '<div class="alert alert-danger">No Question registered</div>';
                                            }
                                            ?>

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
        <script>

            function add_element(id) {
                var row_ids = Math.round(Math.random() * 300000000);
                document.getElementById('add_element' + id).insertAdjacentHTML('beforeend',
                        '<div id="' + row_ids + '"><div class="form-group col-md-10">\n\
     <textarea name="answer[]" rows="2" class="form-control" required></textarea> \n\
 </div>\n\
    <div class="form-group col-md-2" id="add_element">\n\
     <select name="validity[]" class="select2" style="width: 100%" required>\n\
    <option value="0">Wrong</option> \n\
    <option value="1">Correct</option> \n\
</select><button type="button" value="' + row_ids + '" class="btn btn-danger btn-xs pull-right" onclick="delete_item(this.value);">\n\
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