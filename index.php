
<?php
session_start();
require_once 'autoloader.php';

$user_login = new USER();

if($user_login->is_logged_in() != "")
{
    $user_login->redirect('user-account.php');
}

if(isset($_POST['login-button']))
{
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    
    if($user_login->login($email,$pass))
    {
        $user_login->redirect('user-account.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>

	<title>Ya'kov | OOP PHP</title>

	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <div class="column-view">
        <div class="column-view1">
            <div class="rider-options">
                <form class="" method="post" action="#">

                    <div class="left-section">

                        <div class="form-white-background">


                            <div class="form-title-row">
                                <h1>Login to your account</h1>
                            </div>
                                    
                            <div class="form-title-row">
                                <div class="error-section">
                                    <?php 
                                      if(isset($_GET['inactive']))
                                      {
                                        ?>
                                        <div class='alert alert-error'>
                                          <strong>Sorry!</strong> This Account is not Activated,Check email to activate 
                                        </div>
                                    <?php
                                      }
                                    ?>

                                    <?php
                                    if(isset($_GET['error']))
                                      {
                                    ?>
                                        <div class='alert alert-success'>
                                          <strong>Wrong Details!</strong> 
                                        </div>
                                    <?php
                                      }
                                    ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <label>
                                    <span>Email</span>
                                    <input type="email" name="email">
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Password</span>
                                    <input type="password" name="password">
                                </label>
                            </div>

                            <div class="form-row">
                                <button type="submit" name="login-button">Login</button>
                            </div>
                            <a href="user-signup.php">Signup</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
