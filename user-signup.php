<?php

session_start();

require_once 'autoloader.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
    $reg_user->redirect('user-account.php');
}


if(isset($_POST['signup-button']))
{
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $pass = trim($_POST['password']);
    $code = md5(uniqid(rand()));
    
    $stmt = $reg_user->runQuery("SELECT * FROM users_table WHERE email=:email");
    $stmt->execute(array(":email"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($stmt->rowCount() > 0)
    {
        $msg = "
              <div class=''>
                <strong>Sorry !</strong>  email allready exists , Please Try another one
              </div>
              ";
    }
    else
    {
        $reg_user->register($fname,$lname,$email,$phone,$pass,$code);
        
        // if($reg_user->register($fname,$lname,$email,$phone,$pass,$code))
        // {           
        //     $id = $reg_user->lasdID();      
        //     $key = base64_encode($id);
        //     $id = $key;
            
        //     $message = "                    
        //                 Hello $fname $lname,
        //                 <br /><br />
        //                 Welcome to Blue Limo!<br/>
        //                 To complete your registration  please , just click following link<br/>
        //                 <br /><br />
        //                 <a href='http://localhost/php-project-one/confirmation.php?id=$id&code=$code'>Click here to activate your account</a>
        //                 <br /><br />
        //                 Thanks,";
                        
        //     $subject = "Confirm Registration";
                        
        //     $reg_user->send_mail($email,$message,$subject); 
        //     $msg = "
        //             <div class='alert alert-success'>
        //                 <strong>Success!</strong>  Please check your email to activate your account. 
        //             </div>
        //             ";
        // }
        // else
        // {
        //     echo "sorry , Query could no execute...";
        // }       
    }
}
?>

<!DOCTYPE html>
<html>
<head>

	<title>Ya'kov | OOP PHP</title>

	<link rel="stylesheet" href="assets/css/demo.css" type="text/css">
	<link rel="stylesheet" href="assets/css/style.css" type="text/css">

</head>
    <div class="main-content">

        <!-- You only need this form and the form-register.css -->
        <div class="form-register">
            <div class="col-md-4">

                <form class="" method="post" action="#">

                    <div class="left-section">

                        <div class="form-white-background">


                            <div class="form-title-row">
                                <h1>Create account</h1>
                            </div>
                                    
                            <div class="form-title-row">
                                <div class="error-section">
                                    <?php if(isset($msg)) echo $msg;  ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>First Name</span>
                                    <input type="text" name="fname" required>
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Last Name</span>
                                    <input type="text" name="lname" required>
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Email</span>
                                    <input type="email" name="email" required>
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Phone</span>
                                    <input type="text" name="phone" required>
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Password</span>
                                    <input type="password" name="password" required>
                                </label>
                            </div>

                            <div class="form-row">
                                <button type="submit" name="signup-button">Register</button>
                            </div>
                            <a href="index.php">Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
                

    </div>

</body>

</html>
