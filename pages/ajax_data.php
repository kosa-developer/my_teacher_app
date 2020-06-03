<link href="js/select2/css/select2.css" rel="stylesheet" type="text/css" />
<link href="js/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

<?php
if (isset($_POST["submit_text"]) && $_POST['submit_text'] == "policy") {
    $subject = Input::get("subject");
    $staff_id = Input::get("staff_id");
    $staff_name = Input::get('staff_name');
    $code = Input::get('code');
    $email = Input::get('email');
    $system_email = DB::getInstance()->displayTableColumnValue("select Email from system_email where Status=1 and Type='Policy'", 'Email');
    $system_email_password = DB::getInstance()->displayTableColumnValue("select Password from system_email where Status=1 and Type='Policy'", 'Password');

    echo send_policy_Email($staff_id, $email, $staff_name, $code, $system_email, $system_email_password,$subject);
}
if (isset($_POST["submit_text"]) && $_POST['submit_text'] == "exam") {
    $exam_id = Input::get("exam_id");
    $staff_id = Input::get("staff_id");
    $code = Input::get('code');
    $email = Input::get('email');
    $system_email = DB::getInstance()->displayTableColumnValue("select Email from system_email where Status=1 and Type='Policy'", 'Email');
    $system_email_password = DB::getInstance()->displayTableColumnValue("select Password from system_email where Status=1 and Type='Policy'", 'Password');
$student_name=array();
    for($i=0;$i<sizeof($staff_id);$i++){
        $student_name[]=DB::getInstance()->displayTableColumnValue("select Staff_Name from staff where Staff_Id='$staff_id[$i]' and Status=1", 'Staff_Name');
       
  }
   send_exam($staff_id, $email, $student_name, $code, $system_email, $system_email_password,$exam_id);

}
if (isset($_POST["class"]) && !empty($_POST["class"])&&!isset($_POST["return_array"])) {

    $class_id = $_POST["class"];
    $query = "select * from subject WHERE Class_Id='$class_id' and Status=1";
    ?>
    <div class="form-group">
        <label>Subject:</label>
        <select name="subject" class="select2"  style="width: 100%" onchange="returnexam(this.value, 'exam_data');" required>
            <option value="">select</option>
            <?php
            if (DB::getInstance()->checkRows($query)) {
                $subject_query = DB::getInstance()->query($query);
                foreach ($subject_query->results() as $subject) {
                    echo '<option value="' . $subject->Id . '">' . $subject->Subject_Name . '</option>';
                }
            }
            ?>
        </select>
    </div>


    <?php
}if (isset($_POST["class_"]) && !empty($_POST["class_"])&&!isset($_POST["return_array"])) {

    $class_id = $_POST["class_"];
    $query = "select * from subject WHERE Class_Id='$class_id' and Status=1";
    ?>
    <div class="form-group">
        <label>Subject:</label>
        <select name="subject" class="select2"  style="width: 100%" onchange="returnexam(this.value, 'exam_data_');" required>
            <option value="">select</option>
            <?php
            if (DB::getInstance()->checkRows($query)) {
                $subject_query = DB::getInstance()->query($query);
                foreach ($subject_query->results() as $subject) {
                    echo '<option value="' . $subject->Id . '">' . $subject->Subject_Name . '</option>';
                }
            }
            ?>
        </select>
    </div>


    <?php
}if (isset($_POST["subject"]) && !empty($_POST["subject"])&&!isset($_POST['submit_text'])) {

    $subject_id = $_POST["subject"];
    $query = "select * from exam WHERE Subject_Id='$subject_id' and Status=1";
    ?>
    <div class="form-group">
        <label>Exam:</label>
        <select name="exam" class="select2" id="exam" style="width: 100%"  required onchange="returnquestion(this.value, 'returned_question');">
            <option value="">select</option>
            <?php
            if (DB::getInstance()->checkRows($query)) {
                $exam_query = DB::getInstance()->query($query);
                foreach ($exam_query->results() as $exam) {
                    echo '<option value="' . $exam->Id . '">' . $exam->Exam_Name . '</option>';
                }
            }
            ?>
        </select>
    </div>

    <?php
}if (isset($_POST["exam"]) && !empty($_POST["exam"])&&!isset($_POST['submit_text'])) {

    $exam_id = $_POST["exam"];
    $query = "select * from policy_questions WHERE Exam_Id='$exam_id' and Status=1";
    ?>
    <div class="form-group">
        <label>Questions:</label>
        <select name="question" class="select2"  style="width: 100%"  required>
            <option value="">select</option>
            <?php
            if (DB::getInstance()->checkRows($query)) {
                $question_query = DB::getInstance()->query($query);
                foreach ($question_query->results() as $questions) {
                    echo '<option value="' . $questions->Question_Id . '">' . $questions->Question . '</option>';
                }
            }
            ?>
        </select>
    </div>

    <?php
}


if (isset($_POST["type"]) && $_POST["type"] == "submit_policy_answer") {
    $question_id = Input::get('question_id');
     $exam = Input::get('exam');
    $answer = Input::get("answer");
    $staff_id = Input::get("staff_id");
    $choice = Input::get("choice");
    if (DB::getInstance()->checkRows("select * from staff_answer where Question_Id='$question_id' and Staff_Id='$staff_id' and Exam_Id='$exam'") && $choice == 1) {
        $update = DB::getInstance()->query("UPDATE staff_answer SET Answer_Id='$answer' WHERE Question_Id='$question_id' and Staff_Id='$staff_id' and Exam_Id='$exam'");
        if ($update) {
            echo "success";
        }
    } else {
        if (DB::getInstance()->checkRows("select * from staff_answer where Question_Id='$question_id' and Staff_Id='$staff_id' and Answer_Id='$answer' and Exam_Id='$exam'") && $choice > 1) {
            DB::getInstance()->query("DELETE FROM staff_answer WHERE Question_Id='$question_id' and Staff_Id='$staff_id' and Answer_Id='$answer' and Exam_Id='$exam'");
        } else {
            $insert = DB::getInstance()->insert("staff_answer", array(
                "Question_Id" => $question_id,
                "Staff_Id" => $staff_id,
                "Exam_Id" => $exam,
                "Answer_Id" => $answer
            ));
            if ($insert) {
                echo "success";
            }
        }
    }
}
?>


<script src="js/select2/js/select2.js" type="text/javascript"></script>
<script src="js/select2/js/select2-init.js" type="text/javascript"></script>