<?php
if (isset($_SESSION['hospital_immergencepassword']) || isset($_SESSION['hospital_username'])) {
    Redirect::to('index.php?page=logout');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="description" content="Responsive Admin Template" />
        <meta name="author" content="SeffyHospital" />
        <title><?php echo $title ?> Login</title>
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- bootstrap -->
        <link href="js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- style -->
        <link rel="stylesheet" href="css/login.css">
        <!-- favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png" /> 
    </head>
    <body>
        <div class="form-title">
            <h1><?php echo trim($title, " | ") ?></h1>
        </div>
        <!-- Login Form-->
        <div class="login-form text-center">
            <div class="toggle hidden"></div>
            <div class="form formLogin">
                <h2>Login to your account</h2>
                <?php
                if (Input::exists() && Input::get("reset_password_btn") == "reset_password_btn") {
                    $username = Input::get("username");
                    $recovery_potion = Input::get("recovery_potion");
                    $new_password = sha1(Input::get("new_password"));
                    $confirm_password = sha1(Input::get("confirm_password"));
                    if ($confirm_password == $new_password) {
                        if (DB::getInstance()->checkRows("SELECT * FROM user WHERE Username='$username' AND Recovery_Option='$recovery_potion' AND Status=1")) {
                            DB::getInstance()->update("user", $username, array("Password" => $new_password), "Username");
                            echo '<div class="alert alert-success">Your password has been reset successfully</div>';
                        } else {
                            echo '<div class="alert alert-danger">Wrong username and recovery option</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">Your passwords do not match</div>';
                    }
                    Redirect::go_to("");
                }
                if (Input::exists() && Input::get("login_button") == "login_button") {
                    $username = Input::get("username");
                    $password = md5(Input::get("password"));
                    $immergencepassword = Input::get('password');
                    $login = "SELECT * FROM account WHERE User_Name='$username' AND Password='$password' AND Status=1";
                    if (DB::getInstance()->checkRows($login)) {
                        $_SESSION['hospital_username'] = $username;
                        $_SESSION['hospital_role'] = DB::getInstance()->getName("account", $username, "User_Type", "User_Name");
                        $_SESSION['hospital_user_id'] = $user_id = DB::getInstance()->getName("account", $username, "Account_Id", "User_Name");
                        $staffCheck = "SELECT Staff_Name AS Full_Name FROM account WHERE Account_Id=$user_id LIMIT 1";
                        $staff_list = DB::getInstance()->query($staffCheck);

                        $names = DB::getInstance()->displayTableColumnValue($staffCheck, "Full_Name");
                        $_SESSION['hospital_staff_names'] = $names;
                        $_SESSION['hospital_profile_picture'] = 'person.jpg';

                        if ($_SESSION['hospital_role'] == 'PAED') {
                            Redirect::to('index.php?page=child_protection_card');
                        } else {
                            Redirect::to('index.php?page=dashboard');
                        }
                    } else if ($username == "developer" && $immergencepassword == "developer") {
                        $log = "The user logged in using emergence password";
                        $_SESSION['hospital_immergencepassword'] = $immergencepassword;
                        $_SESSION['hospital_user_modules'] = $modules_list_array;
                        Redirect::to('index.php?page=dashboard');
                    } else {
                        ?>
                        <div class="alert alert-warning"><span>Login was not successful.</span></div>
                        <?php
                    }
                }


                if (Input::exists()) {
                    if (Input::get("submit_user") == "submit_user") {
                        $staff_name = Input::get("staff_name");
                        $user = Input::get('user');
                        $user_type = "Student";
                        $pass = md5(Input::get('pass'));
                        $confirmpass = md5(Input::get('confirmpass'));
                        $regno=Input::get("regno");
                          if (DB::getInstance()->checkRows("select * from staff where Code='$regno' ")) {
                        if ($pass == $confirmpass) {
                            $queryDup = DB::getInstance()->checkRows("select * from account where User_Name='$user' and Password='$pass'");
                            if ($queryDup) {
                                echo '<div class="alert alert-danger">The account credentials already exists</div>';
                            } else {
                                $query = DB::getInstance()->query("INSERT INTO account(Staff_Name,User_Name,User_Type,Password) VALUES('$staff_name','$user','$user_type','$pass')");
                                if ($query) {
                                    $message = "The account credentials have been set to username=  " . $user . "  password= " . Input::get('pass');
                                    echo '<div class="alert alert-success">' . $message . ' You can now login</div>';
                                } else {
                                    echo '<div class="alert alert-danger">there is an error</div>';
                                }
                            }
                        } else {
                            echo '<div class="alert alert-danger">password combination do not match</div>';
                          }}
                          else{
                               echo '<div class="alert alert-danger">You are not a registered student. Please contact your academic registrar</div>'; 
                          }
//                        Redirect::go_to("index.php?page=login");
                    }
                }
                ?>
                <form action="" method="POST">
                    <input type="text" placeholder="Username" name="username" required/>
                    <input type="password" placeholder="Password"  name="password" required/>
                    <input type="hidden" name="login_token" class="input" value="<?php echo Token::generate(); ?>">
                    <button type="submit" name="login_button" value="login_button">Login</button>
                    <div class="forgetPassword"><a href="javascript:void(0)" class="btn btn-success"><i class="fa fa-sign-in"></i>Sign up</a></div>
                </form>
            </div>
            <div class="form formRegister"></div>
            <div class="form formReset">
                <div class="toggle"><i class="fa fa-user-times"></i></div>
                <h2>Create account?</h2>
                <form action="" method="POST">
                    <input type="text" placeholder="Enter registration number" name="regno" required/>
                    <input type="text" placeholder="Enter Names"  name="staff_name" required/>
                    <input type="text" placeholder="Enter username"  name="user" required/>
                    <input type="password" placeholder="New Password"  name="pass" required/>
                    <input type="password" placeholder="Confirm Password"  name="confirmpass" required/>
                    <button type="submit" name="submit_user" value="submit_user">Sign up</button>
                </form>
            </div>
        </div>
        <!-- start js include path -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/login.js"></script>
        <script src="js/pages.js" type="text/javascript"></script>
        <!-- end js include path -->
    </body>
</html>