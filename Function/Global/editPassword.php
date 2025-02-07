<?php
session_start();
require('../Init/config.php');
echo "<link rel='stylesheet' type='text/css' href='../../Assets/css/style.css' />"; // Use external css file
?>

<header>
    <div class="header-container">
        <div class="header-container-left">
            <div id="nav_home"> HOME </div>
        </div>
        <div class="header-container-right">
            <div id="nav_apply"> APPLY ROOM </div>
            <div id="nav_view"> VIEW ROOM </div>
            <div id="wrap-icon">
                <i></i>
                <i></i>
                <i></i>
            </div>
        </div>
    </div>
    <div class="wrap-icon-menu">
        <ul id="menu-opt">
            <li>
                <a>MY PROFILE</a>
            </li>
            <li>
                <a> SETTING </a>
            </li>
            <li>
                <a> SIGN OUT </a>
            </li>
        </ul>
    </div>
</header>

<div class = "nav-bar-container">
<nav class = "navigation-bar-edit-profile">
  <ul>
    <li><a href = viewProfile.php>Back</a></li>
    <li><a href = editProfile.php>Personal Information</a></li>
    <?php
      if($_SESSION["LEVEL"] === "Student")
      {
        echo "<li><a href = ../Student/editAcademicInfo.php>Academic Information</a></li>";
      }
    ?>
    <li><a href = editPassword.php  class="active">Change Password</a></li>
  </ul>
</nav>
</div>

<form action ="updateInformation.php" method="post">
<?php
  $currentUser = $_SESSION["USER"];

  $sql = "SELECT * FROM User WHERE Username = '$currentUser'";
  $result = mysqli_query($conn,$sql);

  if($result)
    if(mysqli_num_rows($result)>0)
      while($row = mysqli_fetch_array($result))
        {
          ?>
          <div class = "form-box-container">
          <div class = "form-box">
            <label>Current Password</label> <input type="password" name="currentPassword" class="form-box">
          </div>

          <div class = "form-box">
            <label>New Password (Minimum 6 characters)</label><input type="password" name="newPassword" class="form-box">
          </div>

          <div class = "form-box">
            <label>Re-enter New Password </label><input type="password" name="newRepeatPassword" class="form-box">
          </div>

          <br>
          <div class = "form-box">
            <input type ="submit" name="update_Password" class ="submit-button" value="Update">
          </div>
          <br>
            <?php
        }
?>
</form>

<?php
  if(isset($_GET["error"])){
    if($_GET["error"] == "emptyinput"){
      echo "<script type='text/javascript'>alert('Fill in the fields!');</script>";
    }

    if($_GET["error"] == "pwdwrong"){
      echo "<script type='text/javascript'>alert('Wrong current password!');</script>";
    }

    else if($_GET["error"] == "pwdshort"){
      echo "<script type='text/javascript'>alert('New password need to be atleast 6 characters long!');</script>";
    }

    else if($_GET["error"] == "pwdnotmatch"){
      echo "<script type='text/javascript'>alert('Please re-enter the same new password!');</script>";
    }

    else if($_GET["error"] == "none")
    {
    echo "Password Updated!";
    }
}
  ?>
</div>

<footer>
    <h4>CONNECT</h4> <br>
    <div class="footer-container">
        <div id="footer-left">
            <p>Contact us for more information</p>
            <p>unsource@email.com</p>
            <p>+60 12-345 6789</p>
        </div>

        <div id="footer-right">
            <ul>Connect us on your social media</ul>
        </div>
    </div>
</footer>
