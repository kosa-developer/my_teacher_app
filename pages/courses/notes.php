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
                                    <div class="page-title">Upload notes</div>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12" >
                                <?php
                                if (Input::exists() && Input::get("submit_notes") == "submit_notes") {

                                    $course_unit = Input::get('course_unit');
                                    $year = Input::get("year");
                                    $discription = Input::get("discription");
                                    $file = ($_FILES['file']['name']);
                                    $tmp_name = $_FILES["file"]["tmp_name"];

                                    $duplicate = 0;
                                    $submited = 0;
                                    for ($x = 0; $x < count($discription); $x++) {

                                        if ($file[$x] != "") {
                                            $queryDup = DB::getInstance()->checkRows("select * from notes where file='$file[$x]'");

                                            if (!$queryDup) {

                                                $target_dir = "file_uploads/";
                                                $target_file = $target_dir . basename($file[$x]);
                                                move_uploaded_file($tmp_name[$x], $target_file);

                                                DB::getInstance()->insert("notes", array(
                                                    "course_unit_id" => $course_unit,
                                                    "Year" => $year,
                                                    "Description" => $discription[$x],
                                                    "file" => $file[$x]));
                                                $submited++;
                                            } else {
                                                $duplicate++;
                                            }
                                        }
                                    }

                                    if ($submited > 0) {
                                        echo '<div class="alert alert-success">' . $submited . ' file(s) submitted successfully</div>';
                                    }
                                    if ($duplicate > 0) {
                                        echo '<div class="alert alert-warning">' . $duplicate . ' files already exisits</div>';
                                    }

                                    Redirect::go_to("index.php?page=notes");
                                }
                                ?>
                                <form role="form" action="index.php?page=<?php echo "notes"; ?>"method="POST" enctype="multipart/form-data">
                                    <div class="card card-topline-yellow">
                                        <div class="card-head">
                                            <header>Upload notes</header>
                                        </div>
                                        <div class="card-body " id="bar-parent">

                                            <div class="col-md-12">
                                                <div class="form-group col-md-5">
                                                    <label>Course:</label>
                                                    <select name="course" class="select2" style="width: 100%" onchange="returncourse(this.value, 'courseDiv');" required>
                                                        <option value="">Choose...</option>
                                                        <?php
                                                        $qstn_list = DB::getInstance()->querySample("select * from courses where Status=1 ORDER BY Id");
                                                        foreach ($qstn_list as $qtn):
                                                            echo '<option value="' . $qtn->Id . '">' . $qtn->Course_Name . '</option>';
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label>Course Unit:</label>
                                                    <select name="course_unit" class="select2" id="courseDiv"  required style="width: 100%" >
                                                       
                                                    </select>


                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label>Year:</label>
                                                    <select name="year" class="form-control" required>
                                                        <option value="">Choose...</option>
                                                        <option value="YEAR 1">YEAR 1</option>
                                                        <option value="YEAR 2">YEAR 2</option>
                                                        <option value="YEAR 3">YEAR 3</option>

                                                    </select>
                                                </div>
                                                <div id="Course_Name" class="col-md-10" >
                                                    <div  id="add_element">
                                                        <div class="form-group col-md-5">
                                                            <label>file(s)</label>
                                                            <input name="file[]"  class="form-control" type="file" required accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.pdf" />
                                                        </div>
                                                        <div class="form-group col-md-7" >
                                                            <label>Discription</label>
                                                            <input type="text" name="discription[]" required class="form-control"/>
                                                            <br/>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-success btn-xs pull-right" id="add_more" onclick="add_element();">Add more</button>

                                                </div>




                                            </div>

                                            <div class="box-footer">
                                                <button type="submit"  name="submit_notes" value="submit_notes" class="btn btn-primary pull-right">Submit</button>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>

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
                        '<div id="' + row_ids + '">\n\
     <div class="col-md-5" id="add_element">\n\
    <input name="file[]"  class="form-control" type="file" required accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.pdf" />\n\
    </div> \n\
    <div class="col-md-7" id="add_element">\n\
    <input type="text" name="discription[]" required class="form-control"/>\n\
    </div>\n\
    <button type="button" value="' + row_ids + '" class="btn btn-danger btn-xs" onclick="delete_item(this.value);">\n\
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
