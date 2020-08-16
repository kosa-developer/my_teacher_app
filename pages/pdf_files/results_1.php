<?php
if (($_GET['type']) && ($_GET['type'] == "download_marking_guide")) {

    $subject = $_GET['subject'];
    $class = $_GET['class'];
    $exam = $_GET['exam'];
    $performance_query = "SELECT * FROM staff_performance where Exam_Id='$exam' order by Staff_Performance desc";
    $performance_list = DB::getInstance()->querySample($performance_query);
    $Subject_Name = DB::getInstance()->displayTableColumnValue("select Subject_Name from subject where Id='$subject'", "Subject_Name");
    $Class_Name = DB::getInstance()->displayTableColumnValue("select Class_Name from class where Id='$class'", "Class_Name");
    $Exam_Name = DB::getInstance()->displayTableColumnValue("select Exam_Name from exam where Id='$exam'", "Exam_Name");

    $heading = $Subject_Name . " " . $Exam_Name . " " . $Class_Name;
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename= " . $heading . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<center><h2>Marking guide For " . $Subject_Name . " " . $Exam_Name . " " . $Class_Name . "</h2></center>";



    $queryquestion = 'SELECT * FROM policy_questions WHERE Status=1 and Exam_Id="' . $exam . '" ORDER BY Question_Id' . $limit;
    if (DB::getInstance()->checkRows($queryquestion)) {
        ?>
       
            <table style="font-size: 15px; width: 50%;text-align: left;" border="1" >
                  <thead>
                <tr>
                    <th style="width: 1%;">#</th>
                    <th >Question</th>
                    <th >Marks @qtn</th>
                    <th >Answers</th>
                 
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
                                echo "<strong>" . $alphabet . ".</strong> " . $answerx->Answer . "<b style='" . $colorz . "'>(" . $correct = ($answerx->Correct == 1) ? "correct" : "wrong";
                                echo ").</b> <br/><br/>";
                                $count_answer++;
                            }
                            ?></td>
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
                  
                </tr>
            </tfoot>

        </table>
        <?php
    } else {
        echo '<div class="alert alert-danger">No Question registered</div>';
    }
    $pdf->AutoPrint();
    $pdf->Output();
    //$pdf->output('D', 'PATIENT ADMISSION FACE SHEET' . ' ' . date("Ymdhis") . '.pdf');
}

if (($_GET['type']) && ($_GET['type'] == "download_results")) {

    require ('pdf_header.php');
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $subject = $_GET['subject'];
    $class = $_GET['class'];
    $exam = $_GET['exam'];
    $performance_query = "SELECT * FROM staff_performance where Exam_Id='$exam' order by Staff_Performance desc";
    $performance_list = DB::getInstance()->querySample($performance_query);
    $Subject_Name = DB::getInstance()->displayTableColumnValue("select Subject_Name from subject where Id='$subject'", "Subject_Name");
    $Class_Name = DB::getInstance()->displayTableColumnValue("select Class_Name from class where Id='$class'", "Class_Name");
    $Exam_Name = DB::getInstance()->displayTableColumnValue("select Exam_Name from exam where Id='$exam'", "Exam_Name");


    $pdf->AddPage();
    $pdf->SetTextColor(0, 0, 0);
    $pdf->createHeader('UGANDA NURSING SCHOOL BWINDI', 185);
    $pdf->Cell(0, 5, "(EXCELLENCE WITH COMPASSION)", 0, 1, "C");
    $pdf->Cell(0, 10, "Students Performance For " . $Subject_Name . " " . $Exam_Name . " " . $Class_Name, 0, 1, "C");

    $pdf->SetTextColor(0, 0, 0);

    if (DB::getInstance()->checkRows($performance_query)) {
        $pdf->Cell(10, 7, "#", 1, 0, "L");
        $pdf->Cell(90, 7, "Students:  ", 1, 0, "L");
        $pdf->Cell(80, 7, "Performance:  ", 1, 1, "L");
        $overall_marks = DB::getInstance()->calculateSum("select Total_Marks from total_correct_answer where Exam_Id='$exam' ", 'Total_Marks');

        $no = 1;
        foreach ($performance_list as $staff_performance) {
            $performance = round((($staff_performance->Staff_Performance / $overall_marks) * 100));
            $pdf->Cell(10, 7, $no, 1, 0, "L");
            $pdf->Cell(90, 7, $staff_performance->Staff_Name, 1, 0, "L");
            $pdf->Cell(80, 7, $performance . "%", 1, 1, "L");
            $no++;
        }
    } else {
        $pdf->Cell(0, 5, "No data to display", 0, 1, "C");
    }
    $pdf->AutoPrint();
    $pdf->Output();
    //$pdf->output('D', 'PATIENT ADMISSION FACE SHEET' . ' ' . date("Ymdhis") . '.pdf');
}
?>