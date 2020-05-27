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
    $subject = Input::get("subject");
    $staff_id = Input::get("staff_id");
    $code = Input::get('code');
    $email = Input::get('email');
    $system_email = DB::getInstance()->displayTableColumnValue("select Email from system_email where Status=1 and Type='Policy'", 'Email');
    $system_email_password = DB::getInstance()->displayTableColumnValue("select Password from system_email where Status=1 and Type='Policy'", 'Password');
$student_name=array();
    for($i=0;$i<sizeof($staff_id);$i++){
        $student_name[]=DB::getInstance()->displayTableColumnValue("select Staff_Name from staff where Staff_Id='$staff_id[$i]' and Status=1", 'Staff_Name');
       
  }
   send_exam($staff_id, $email, $student_name, $code, $system_email, $system_email_password,$subject);

}
if (isset($_POST["class"]) && !empty($_POST["class"])&&!isset($_POST["return_array"])) {

    $class_id = $_POST["class"];
    $query = "select * from subject WHERE Class_Id='$class_id' and Status=1";
    ?>
    <div class="form-group">
        <label>Subject:</label>
        <select name="subject" class="select2"  style="width: 100%" onchange="returnquestion(this.value, 'returned_question');" required>
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
    $query = "select * from policy_questions WHERE Subject_Id='$subject_id' and Status=1";
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
     $subject_id = Input::get('subject');
    $answer = Input::get("answer");
    $staff_id = Input::get("staff_id");
    $choice = Input::get("choice");
    if (DB::getInstance()->checkRows("select * from staff_answer where Question_Id='$question_id' and Staff_Id='$staff_id' and Subject_Id='$subject_id'") && $choice == 1) {
        $update = DB::getInstance()->query("UPDATE staff_answer SET Answer_Id='$answer' WHERE Question_Id='$question_id' and Staff_Id='$staff_id' and Subject_Id='$subject_id'");
        if ($update) {
            echo "success";
        }
    } else {
        if (DB::getInstance()->checkRows("select * from staff_answer where Question_Id='$question_id' and Staff_Id='$staff_id' and Answer_Id='$answer' and Subject_Id='$subject_id'") && $choice > 1) {
            DB::getInstance()->query("DELETE FROM staff_answer WHERE Question_Id='$question_id' and Staff_Id='$staff_id' and Answer_Id='$answer' and Subject_Id='$subject_id'");
        } else {
            $insert = DB::getInstance()->insert("staff_answer", array(
                "Question_Id" => $question_id,
                "Staff_Id" => $staff_id,
                "Subject_Id" => $subject_id,
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