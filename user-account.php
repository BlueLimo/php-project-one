<?php
session_start();
require_once 'autoloader.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
    //redirect function
    $user_home->redirect('index.php');
}
//run query function
$stmt = $user_home->runQuery("SELECT * FROM users_table WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>

	<title>Ya'kov | OOP PHP</title>

	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="stylesheet" href="assets/css/style.css">

</head>
    <div class="row-view">
        <div class="column-view1">
            <div class="rider-options">
                <div class="optionone optione1">
                    <div class="option-header">
                        <h2>My Account</h2>
                    </div>
                    <div class="option-content">
                        <table class="profile-table" style="width: 100%;">
                            <tr>
                                <th style="font-weight: lighter;">Name:</td>
                                <td><?php echo $row['fname'] . ' ' .$row['lname'] ?></td>
                            </tr>
                            <tr>
                                <th style="font-weight: lighter;">Email:</td>
                                <td><?php echo $row['email'] ?></td>
                            </tr>
                            <tr>
                                <th style="font-weight: lighter;">Phone:</td>
                                <td><?php echo $row['phone'] ?></td>
                            </tr>
                        </table>

                    </div>
                    <a href="logout.php" class="form-facebook-button">Logout</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>