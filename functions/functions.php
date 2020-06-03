<?php

function send_exam($staff_id, $email, $user, $code, $system_email, $system_email_password, $exam_id) {

    require 'PHPMailerAutoload.php';
    for ($i = 0; $i < sizeof($staff_id); $i++) {
        $exam_name = DB::getInstance()->displayTableColumnValue("select Exam_Name from exam where Id='$exam_id'", "Exam_Name");
        $subject = DB::getInstance()->displayTableColumnValue("select Subject_Id from exam where Id='$exam_id'", "Subject_Id");
        $Subject_Name = DB::getInstance()->displayTableColumnValue("select Subject_Name from subject where Id='$subject'", "Subject_Name");
        $Class_Name = DB::getInstance()->displayTableColumnValue("select Class_Name from class,staff where staff.Class_Id=class.Id and staff.Staff_Id='$staff_id[$i]'", "Class_Name");

        $mail = new PHPMailer;

        $mail->SMTPDebug = 4;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $system_email;                 // SMTP username
        $mail->Password = $system_email_password;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom($system_email, 'UNSB EXAM');
        $mail->addAddress($email[$i], $user[$i]);     // Add a recipient            // Name is optional
//$mail->addReplyTo($email);
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'UNSB Exams';
        $mail->Body = 'Hello ' . $user[$i] . ' ,<br/>'
                . 'Hope you are doing well.<br/>'
                . 'An assessment for <b>'.$Class_Name.' '.$Subject_Name.' '.$exam_name.' </b>is ready for you<br/>'
                . 'Please follow the link below, read the notes provided and answer the questions as follows. <br/>'
                . 'https://myteacher.unsbwindi.ac.ug/index.php?page=policy_document_page&code=' . $code[$i] . '&exam=' . $exam_id . '<br/>'
                . 'Thanks.<br/>'
                . 'Best regards.<br/>'
                . 'Academic Registrar UNSB.';

        if (!$mail->send()) {
            echo 'Exam could not be sent';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Exam has been successfully sent';
            DB::getInstance()->insert("policy_codes", array(
                "Code" => $code[$i],
                "Exam_Id" => $exam_id,
                "Email" => $email[$i],
                "Staff_Id" => $staff_id[$i]
            ));
        }
    }
}

function send_policy_Email($staff_id, $email, $user, $code, $system_email, $system_email_password, $subject) {
    require 'PHPMailerAutoload.php';
    $mail = new PHPMailer;

    $mail->SMTPDebug = 4;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $system_email;                 // SMTP username
    $mail->Password = $system_email_password;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom($system_email, 'developer');
    $mail->addAddress($email, $user);     // Add a recipient            // Name is optional
//$mail->addReplyTo($email);
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'UNSB Exams';
    $mail->Body = 'Hello ' . $user . ' ,<br/>'
            . 'Hope you are doing well.<br/>'
            . 'Please follow the link below, read the document and answer the questions provided. <br/>'
            . 'http://127.0.0.1:81/myteacher_app/index.php?page=policy_document_page&code=' . $code . '&subject=' . $subject . '<br/>'
            . 'Thanks.<br/>'
            . 'Best regards.<br/>'
            . 'Head of nursing and Midwifery services.<br/>'
            . 'Bwindi community hospital.';

    if (!$mail->send()) {
        echo 'Exam could not be sent';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Exam has been successfully sent';
        DB::getInstance()->insert("policy_codes", array(
            "Code" => $code,
            "Subject_Id" => $subject,
            "Email" => $email,
            "Staff_Id" => $staff_id
        ));
    }
}

function generatePassword($length = 8) {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);

    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
        $length = $maxlength;
    }

    // set up a counter for how many characters are in the password so far
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {

        // pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, $maxlength - 1), 1);

        // have we already used this character in $password?
        if (!strstr($password, $char)) {
            // no, so it's OK to add it onto the end of whatever we've already got...
            $password .= $char;
            // ... and increase the counter by one
            $i++;
        }
    }

    // done!
    return $password;
}

function generatePasswordz($length = 6) {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);

    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
        $length = $maxlength;
    }

    // set up a counter for how many characters are in the password so far
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {

        // pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, $maxlength - 1), 1);

        // have we already used this character in $password?
        if (!strstr($password, $char)) {
            // no, so it's OK to add it onto the end of whatever we've already got...
            $password .= $char;
            // ... and increase the counter by one
            $i++;
        }
    }

    // done!
    return $password;
}

function escape($string) {
    return htmlentities($string);
}

function english_date($date) {
    $create_date = date_create($date);
    $new_date = date_format($create_date, "j M Y");
    return $new_date;
}

function redirect($message, $url) {
    ?>
    <script type="text/javascript">
        //        function Redirect()
        //        {
        //            window.location = "<?php echo $url; ?>";
        //        }
        //        alert('<?php echo $message; ?>');
        //        setTimeout('Redirect()', 10);
        alert('<?php echo $message; ?>');
        window.location = "<?php echo $url; ?>"
    </script>
    <?php
}

function english_date_time($date) {
    $create_date = date_create($date);
    $new_date = date_format($create_date, "jS F Y  H:i:s a");
    return $new_date;
}

function english_time($date) {
    $create_date = date_create($date);
    $new_date = date_format($create_date, "H:i:s a");
    return $new_date;
}

function ugandan_shillings($value) {
    $value = number_format($value, 0, ".", ",");
    return $value . " UGx";
}

function increaseDateToDate($value, $type, $dateConvert) {
    $date = date_create($dateConvert);
    date_add($date, date_interval_create_from_date_string($value . ' ' . $type));
    return date_format($date, 'Y-m-d');
}

function calculateAge($smallDate, $largeDate) {
    $age = "";
    $diff = date_diff(date_create($smallDate), date_create($largeDate));
    $age .= ($diff->y > 0) ? $diff->y . "Y " : "";
    $age .= ($diff->m > 0 && $diff->y < 10) ? $diff->m . "M " : "";
    $age .= ($diff->d > 0 && $diff->y < 1) ? $diff->d . "D " : "";
    $age = ($age != "") ? $age : 0;
    return $age;
}

function calculateDateDifference($smallDate, $largeDate, $type) {
    $age = 0;
    $diff = strtotime($largeDate) - strtotime($smallDate);
    $age = ($type == "years") ? $diff / (60 * 60 * 24 * 30 * 12) : $age;
    $age = ($type == "months") ? $diff / (60 * 60 * 24 * 30) : $age;
    $age = ($type == "days") ? $diff / (60 * 60 * 24) : $age;
    return $age;
}

//Function to generate a tag
function generate_tag($code, $middle, $string_value) {
    $code = ($code != "") ? $code . "-" : "";
    $middle = ($middle != "") ? $middle . "-" : "";
//    $strData = explode(' ', $string_value);
//    $tag = '';
//    foreach ($strData as $substring_data) {
//        $tag .= strtoupper(substr($substring_data, 0, 1));
//    }
    $Tag = $code . $middle . str_pad($string_value, 2, '0', STR_PAD_LEFT);
    return $Tag;
}
?>
