<?php

require ('pdf_header.php');
$pdf = new PDF();
$pdf->AliasNbPages();
if (($_GET['type']) && ($_GET['type'] == "download_results")) {

    $subject = $_GET['subject'];
    $class = $_GET['class'];
    $performance_query = "SELECT * FROM staff_performance where Subject_Id='$subject' order by Staff_Performance desc";
    $performance_list = DB::getInstance()->querySample($performance_query);
    $Subject_Name = DB::getInstance()->displayTableColumnValue("select Subject_Name from subject where Id='$subject'", "Subject_Name");
    $Class_Name = DB::getInstance()->displayTableColumnValue("select Class_Name from class where Id='$class'", "Class_Name");



    $pdf->AddPage();
    $pdf->SetTextColor(0, 0, 0);
    $pdf->createHeader('UGANDA NURSING SCHOOL BWINDI', 185);
    $pdf->Cell(0, 5, "(EXCELLENCE WITH COMPASSION)", 0, 1, "C");
    $pdf->Cell(0, 10, "Students Performance For ". $Subject_Name." ".$Class_Name, 0, 1, "C");

    $pdf->SetTextColor(0, 0, 0);

    if (DB::getInstance()->checkRows($performance_query)) {
        $pdf->Cell(10, 7, "#", 1, 0, "L");
        $pdf->Cell(90, 7, "Students:  ", 1, 0, "L");
        $pdf->Cell(80, 7, "Performance:  ", 1, 1, "L");
        $overall_marks = DB::getInstance()->calculateSum("select Total_Marks from total_correct_answer where Subject_Id='$subject' ", 'Total_Marks');

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