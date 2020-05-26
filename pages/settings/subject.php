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
                                    <div class="page-title">Subject</div>
                                </div>
                                <div class="actions panel_actions pull-right">
                                    <a class="btn btn-primary" href="index.php?page=<?php echo "subject" . '&mode=' . $modez = ($mode == 'registered') ? 'register' : 'registered'; ?>"><i class="fa fa-eye"></i><?php echo $modez = ($mode == 'registered') ? 'Register' : 'Registered'; ?> Subject(s)</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12" <?php echo $hidden; ?>>
                                <?php
                                if (Input::exists() && Input::get("submit_subject") == "submit_subject") {
                                    $class = Input::get('class');
                                    $subject = Input::get('subject');
                                    $duplicate = 0;
                                    $submited = 0;
                                    for ($i = 0; $i < sizeof($subject); $i++) {
                                        $queryDup = DB::getInstance()->checkRows("select * from subject where Subject_Name='$subject[$i]' and Class_Id='$class'");
                                        if (!$queryDup) {
                                            DB::getInstance()->insert("subject", array(
                                                "Subject_Name" => $subject[$i],
                                                "Class_Id" => $class));
                                            $submited++;
                                        } else {
                                            $duplicate++;
                                        }
                                    }
                                    if ($submited > 0) {
                                        echo '<div class="alert alert-success">' . $submited . ' Subject_Name(s) submitted successfully</div>';
                                    }
                                    if ($duplicate > 0) {
                                        echo '<div class="alert alert-warning">' . $duplicate . ' Subject_Names already exisits</div>';
                                    }
                                    Redirect::go_to("index.php?page=subject&mode=" . $mode);
                                }
                                ?>
                                <form role="form" action="index.php?page=<?php echo "subject" . '&mode=' . $mode; ?>"method="POST" enctype="multipart/form-data">
                                    <div class="card card-topline-yellow">
                                        <div class="card-head">
                                            <header>Register subject</header>
                                        </div>
                                        <div class="card-body col-md-6" id="bar-parent">
                                            <div class="form-group">
                                                <label>Class:</label>
                                                <select name="class" class="select2" style="width: 100%" required>
                                                    <option value="">Choose...</option>
                                                    <?php
                                                    $qstn_list = DB::getInstance()->querySample("select * from class ORDER BY Id");
                                                    foreach ($qstn_list as $qtn):
                                                        echo '<option value="' . $qtn->Id . '">' . $qtn->Class_Name . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div id="Subject_Name" >
                                                <button type="button" class="btn btn-success btn-xs pull-right" id="add_more" onclick="add_element();">Add more subjects</button>

                                                <div class="form-group" id="add_element">

                                                    <div class="form-group ">
                                                        <label>Subject(es)</label>
                                                        <input type="text" name="subject[]" required class="form-control"/>
                                                    </div>

                                                    <br/> </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit"  name="submit_subject" value="submit_subject" class="btn btn-primary pull-right">Submit</button>
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

                                    $subject_id = $_GET['Id'];
                                    $query = DB::getInstance()->query("UPDATE subject SET Status=0 WHERE Id='$subject_id'");
                                    if ($query) {

                                        $Subject_Name = DB::getInstance()->displayTableColumnValue("select Subject_Name from subject where Id='$subject_id' ", "Subject_Name");

                                        echo $message = "<center><h4 style='color:red'>data has been deleted successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=subject&mode=" . $mode);
                                }
                                if (Input::exists() && Input::get("edit_subject") == "edit_subject") {
                                    $Id = Input::get('Id');
                                    $Subject_Name = Input::get('Subject_Name');
                                    $class_id=Input::get('class');
                                    
                                    $editSubject_Name = DB::getInstance()->update("subject", $Id, array(
                                        "Subject_Name" => $Subject_Name,
                                        "Class_Id" => $class_id), "Id");


                                    if ($editSubject_Name) {
                                       
                                        echo $message = "<center><h4 style='color:blue'>Data has been edited successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=subject&mode=" . $mode);
                                }
                                ?>

                                <div class="card card-topline-yellow">
                                    <div class="card-head">
                                        <header><?php echo $modez = ($mode == 'registered') ? '' : 'Last entered 10 '; ?>Subject_Names List</header>
                                    </div>
                                    <div class="card-body " id="bar-parent">
                                        <?php
                                        $querySubject_Name = 'SELECT * FROM subject WHERE Status=1 ORDER BY Id' . $limit;
                                        if (DB::getInstance()->checkRows($querySubject_Name)) {
                                            ?>
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 1%;">#</th>
                                                        <th >Class</th>
                                                        <th >Subject_Name</th>
                                                        <th style="width: 20%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $data_got = DB::getInstance()->querySample($querySubject_Name);
                                                    $no = 1;
                                                    foreach ($data_got as $Subject_Namex) {
                                                        ?>
                                                        <tr> 
                                                            <td style="width: 1%;"><?php echo $no; ?></td>
                                                            <td><?php echo DB::getInstance()->displayTableColumnValue("select Class_Name from class where Id='$Subject_Namex->Class_Id' ", "Class_Name") ?></td>
                                                            <td><?php echo $Subject_Namex->Subject_Name; ?></td>
                                                            <td style="width: 20%;">
                                                                <div class="btn-group xs">
                                                                    <button type="button" class="btn btn-success">Action</button>
                                                                    <button type="button" class="btn btn-success  dropdown-toggle" data-toggle="dropdown">
                                                                        <span class="caret"></span>
                                                                        <span class="sr-only">Toggle Dropdown</span>
                                                                    </button>
                                                                    <ul class="dropdown-menu" role="menu">

                                                                        <li><a  data-toggle="modal" data-target="#modal-<?php echo $Subject_Namex->Id; ?>">Edit</a></li>
                                                                        <li><a href="index.php?page=<?php echo "subject" . '&action=delete&Id=' . $Subject_Namex->Id . '&mode=' . $mode; ?>" onclick="return confirm('Are you sure you want to delete <?php echo $Subject_Namex->Subject_Name; ?>?');">Delete</a></li>
                                                                        <li class="divider"></li>

                                                                    </ul>
                                                                </div>

                                                            </td>

                                                    <div class="modal fade" id="modal-<?php echo $Subject_Namex->Id; ?>">
                                                        <div class="modal-dialog">
                                                            <form role="form" action="index.php?page=<?php echo"subject" . '&mode=' . $mode; ?>" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span></button>

                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="Id" value="<?php echo $Subject_Namex->Id ?>">
                                                                        <div class="form-group">
                                                                            <label>Class:</label>
                                                                            <select name="class" class="select2" style="width: 100%" required>
                                                                                <option value="">Choose...</option>
                                                                                <?php
                                                                                $qstn_list = DB::getInstance()->querySample("select * from class ORDER BY Id");
                                                                                foreach ($qstn_list as $qtn):
                                                                                    $selected=($Subject_Namex->Class_Id==$qtn->Id)?"selected":"";
                                                                                    echo '<option value="' . $qtn->Id . '" '.$selected.'>' . $qtn->Class_Name . '</option>';
                                                                                endforeach;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Subject_Name(s)</label>
                                                                            <input type="text" name="Subject_Name"  class="form-control" value="<?php echo $Subject_Namex->Subject_Name ?>" required/>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="edit_subject" value="edit_subject" class="btn btn-primary">Save changes</button>
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
                                                        <th>Subject_Name</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                            <?php
                                        } else {
                                            echo '<div class="alert alert-danger">No Subject registered</div>';
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
     <input type="text" name="subject[]" rows="2" class="form-control" required/> \n\
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