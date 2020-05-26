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
                <?php include_once 'includes/side_menu.php'; ?>
                <!-- end sidebar menu -->
                <!-- start page content -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <div class="page-title-breadcrumb">
                                <div class=" pull-left">
                                    <div class="page-title">System Users</div>
                                </div>
                                <div class="actions panel_actions pull-right">
                                    <a class="btn btn-primary" href="index.php?page=add_user"><i class="fa fa-plus"></i> Add User</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-topline-yellow">
                                    <div class="card-head">
                                        <header>List of all registered users</header>
                                    </div>
                                    <div class="card-body ">
                                        <?php
                                          if (Input::get("edituserButton") == "edituserButton") {
                                $user_type = strtoupper(Input::get("user_type"));
                                $user_id = Input::get("user_id");
                                $queryUpdateSubject = DB::getInstance()->update('account', $user_id, array('User_Type' => $user_type), 'Account_Id');
                                if ($queryUpdateSubject) {
                                    echo'<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Account updated successfully</strong></div>';
                                } else {
                                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error in updating the Account</strong></div>';
                                }
                                Redirect::go_to("index.php?page=view_users");
                            }
                            if (Input::get("deactivate")) {
                                $user_id = Input::get("deactivate");
                                $queryUpdateSubject = DB::getInstance()->update('account', $user_id, array('Status' => 0), 'Account_Id');
                                if ($queryUpdateSubject) {
                                    echo'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Account Deactivated</strong></div>';
                                } else {
                                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error in updating the Account</strong></div>';
                                }
                                Redirect::go_to("index.php?page=view_users");
                            }
                            if (Input::get("activate")) {
                                $user_id = Input::get("activate");
                                $queryUpdateSubject = DB::getInstance()->update('account', $user_id, array('Status' => 1), 'Account_Id');
                                if ($queryUpdateSubject) {
                                    echo'<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Account Activates</strong></div>';
                                } else {
                                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error in updating the Account</strong></div>';
                                }
                                Redirect::go_to("index.php?page=view_users");
                            }
                            
                            
                                        $selectuser = "SELECT * FROM account WHERE Status=1  ORDER BY Account_Id desc";
                                        if (DB::getInstance()->checkRows($selectuser)) {
                                            ?>

                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr><th>Name</th>
                                                        <th>User Name</th>
                                                        <th>User Type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $user_list = DB::getInstance()->query($selectuser);
                                                    foreach ($user_list->results() as $user) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $user->Staff_Name; ?></td>
                                                            <td><?php echo $user->User_Name; ?></td>

                                                            <td><?php
                                                                if ($user->User_Type != NULL) {
                                                                    echo $user->User_Type;
                                                                } else {
                                                                    ?>
                                                                    <a data-toggle='modal'href="#modal-form<?php echo $user->Account_Id; ?>" class='fa fa-pencil-square-o'></a><?php } ?></td>
                                                            <td><?php
                                                                if ($user->Status == 1) {
                                                                    $name = "deactivate";

                                                                    $class = "btn btn-danger  btn-xs";
                                                                } else {
                                                                    $class = "btn btn-success btn-xs";
                                                                    $name = "activate";
                                                                }
                                                                ?>
                                                                <?php if ($user->User_Type != "ADMIN") { ?>
                                                                    <form role="form" action="" method="POST">
                                                                        <button type="submit" name="<?php echo $name; ?>" value="<?php echo $user->Account_Id; ?>" class="<?php echo $class; ?>"><?php echo $name; ?></button>  
                                                                    </form><?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    $s_number++;
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                            <?php
                                        } else {
                                            echo '<div class="alert alert-danger">No staff Accounts registered</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
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
        <?php include_once 'includes/footer_js.php'; ?>

        <!-- end js include path -->
    </body>

</html>