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
                                    <div class="page-title">Classes</div>
                                </div>
                                <div class="actions panel_actions pull-right">
                                    <a class="btn btn-primary" href="index.php?page=<?php echo "class". '&mode=' . $modez = ($mode == 'registered') ? 'register' : 'registered'; ?>"><i class="fa fa-eye"></i><?php echo $modez = ($mode == 'registered') ? 'Register' : 'Registered'; ?> Class(es)</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12" <?php echo $hidden; ?>>
                                <?php
                                if (Input::exists() && Input::get("submit_Class_Name") == "submit_Class_Name") {
                                    $Class_Name = Input::get('Class_Name');
                                    $duplicate = 0;
                                    $submited = 0;
                                    for ($i = 0; $i < sizeof($Class_Name); $i++) {
                                        $queryDup = DB::getInstance()->checkRows("select * from class where Class_Name='$Class_Name[$i]'");
                                        if (!$queryDup) {
                                            DB::getInstance()->insert("class", array(
                                                "Class_Name" => $Class_Name[$i]));
                                            $submited++;
                                            $log = $_SESSION['hospital_staff_names'] . "  registered a new staff :" . $staff_name;
                                            DB::getInstance()->logs($log);
                                        } else {
                                            $duplicate++;
                                        }
                                       
                                    }
                                     if ($submited > 0) {
                                            echo '<div class="alert alert-success">' . $submited . ' Class_Name(s) submitted successfully</div>';
                                        }
                                        if ($duplicate > 0) {
                                            echo '<div class="alert alert-warning">' . $duplicate . ' Class_Names already exisits</div>';
                                        }
                                    Redirect::go_to("index.php?page=class&mode=" . $mode);
                                }
                                ?>
                                <form role="form" action="index.php?page=<?php echo "class" . '&mode=' . $mode; ?>"method="POST" enctype="multipart/form-data">
                                    <div class="card card-topline-yellow">
                                        <div class="card-head">
                                            <header>Register Classes</header>
                                        </div>
                                        <div class="card-body col-md-6" id="bar-parent">

                                            <div id="Class_Name" >
                                                <button type="button" class="btn btn-success btn-xs pull-right" id="add_more" onclick="add_element();">Add more</button>
                                                <div class="form-group" id="add_element">
                                                    <label>class(es)</label>
                                                    <input type="text" name="Class_Name[]" required class="form-control"/>

                                                    <br/> </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit"  name="submit_Class_Name" value="submit_Class_Name" class="btn btn-primary pull-right">Submit</button>
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

                                    $quetion_id = $_GET['Id'];
                                    $query = DB::getInstance()->query("UPDATE class SET Status=0 WHERE Id='$quetion_id'");
                                    if ($query) {

                                        $Class_Name = DB::getInstance()->displayTableColumnValue("select Class_Name from class where Id='$quetion_id' ", "Class_Name");
                                        $log = $_SESSION['hospital_staff_names'] . "  deleted " . $Class_Name . "s information";
                                        DB::getInstance()->logs($log);
                                        echo $message = "<center><h4 style='color:red'>data has been deleted successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=class&mode=" . $mode);
                                }
                                if (Input::exists() && Input::get("edit_class") == "edit_class") {
                                    $Id = Input::get('Id');
                                    $Class_Name = Input::get('Class_Name');
                                    $Class_Name_z = DB::getInstance()->displayTableColumnValue("select Class_Name from class where Id='$Id' ", "Class_Name");

                                    $editClass_Name = DB::getInstance()->update("class", $Id, array(
                                        "Class_Name" => $Class_Name), "Id");


                                    if ($editClass_Name) {
                                        $log = $_SESSION['hospital_staff_names'] . "  edited " . $Class_Name_z . " to " . $Class_Name;
                                        DB::getInstance()->logs($log);
                                        echo $message = "<center><h4 style='color:blue'>data has been edited successfully</h4></center>";
                                    } else {
                                        echo $error = "<center><h4 style='color:red'>there is a server error</h4></center>";
                                    }
                                    Redirect::go_to("index.php?page=class&mode=" . $mode);
                                }
                                ?>

                                <div class="card card-topline-yellow">
                                    <div class="card-head">
                                        <header><?php echo $modez = ($mode == 'registered') ? '' : 'Last entered 10 '; ?>Class_Names List</header>
                                    </div>
                                    <div class="card-body " id="bar-parent">
                                        <?php
                                        $queryClass_Name = 'SELECT * FROM class WHERE Status=1 ORDER BY Id' . $limit;
                                        if (DB::getInstance()->checkRows($queryClass_Name)) {
                                            ?>
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 1%;">#</th>
                                                        <th >Class_Name</th>
                                                        <th style="width: 20%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $data_got = DB::getInstance()->querySample($queryClass_Name);
                                                    $no = 1;
                                                    foreach ($data_got as $Class_Namex) {
                                                        ?>
                                                        <tr> 
                                                            <td style="width: 1%;"><?php echo $no; ?></td>
                                                            <td><?php echo $Class_Namex->Class_Name; ?></td>
                                                            <td style="width: 20%;">
                                                                <div class="btn-group xs">
                                                                    <button type="button" class="btn btn-success">Action</button>
                                                                    <button type="button" class="btn btn-success  dropdown-toggle" data-toggle="dropdown">
                                                                        <span class="caret"></span>
                                                                        <span class="sr-only">Toggle Dropdown</span>
                                                                    </button>
                                                                    <ul class="dropdown-menu" role="menu">

                                                                        <li><a  data-toggle="modal" data-target="#modal-<?php echo $Class_Namex->Id; ?>">Edit</a></li>
                                                                        <li><a href="index.php?page=<?php echo "class" . '&action=delete&Id=' . $Class_Namex->Id . '&mode=' . $mode; ?>" onclick="return confirm('Are you sure you want to delete <?php echo $Class_Namex->Class_Name; ?>?');">Delete</a></li>
                                                                        <li class="divider"></li>

                                                                    </ul>
                                                                </div>

                                                            </td>

                                                    <div class="modal fade" id="modal-<?php echo $Class_Namex->Id; ?>">
                                                        <div class="modal-dialog">
                                                            <form role="form" action="index.php?page=<?php echo"class" . '&mode=' . $mode; ?>" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span></button>

                                                                    </div> <div class="modal-body">
                                                                        <input type="hidden" name="Id" value="<?php echo $Class_Namex->Id ?>">
                                                                        <div class="form-group">
                                                                            <label>Class_Name(s)</label>
                                                                            <input type="text" name="Class_Name"  class="form-control" value="<?php echo $Class_Namex->Class_Name ?>" required/>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="edit_class" value="edit_class" class="btn btn-primary">Save changes</button>
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
                                                        <th>Class_Name</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                            <?php
                                        } else {
                                            echo '<div class="alert alert-danger">No Class registered</div>';
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
                        '<div id="' + row_ids + '">\n\
     <input type="text" name="Class_Name[]" rows="2" class="form-control" required/> \n\
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