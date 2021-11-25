<!-- getting the auth status of user -->
<?php
require_once "components/auth-status.php";
// require_once "components/config.php";
?>

<!-- navbar -->
<div class="header-container">
    <img src="static/icon.png" alt="Email Sercvices" class="icon">
    <h1 class="company-name">Email Serices</h1>
</div>
<ul class="navbar">
    <li>
        <a class="nav-btn" href="index.php">
            <span class="fas fa-home"></span>
            Home
        </a>
    </li>
    <li>
        <a class="nav-btn" href="about.php">
            <span class="fas fa-users"></span>
            About
        </a>
    </li>

    <?php

    // managing the html of nav bar according to authentication
    if ($auth_status == true) {
        // html of inbox btn
        $inboxBtn = '<li>
            <a class="nav-btn" href="inbox.php">
            <span class="fas fa-envelope"></span>
            Inbox
            </a>
            </li>';

        // html of send mails
        $sendmailBtn = '<li>
            <a class="nav-btn" href="send-mails.php">
            <span class="fas fa-envelope"></span>
            Send Mails
            </a>
            </li>';

        // html of write mail btn
        $writeMailBtn = '<li>
            <a class="nav-btn" href="write-mail.php">
            <span class="fas fa-edit"></span>
            Write Email
            </a>
            </li>';

        // html of log out btn
        $logoutBtn = '<li>
            <a class="nav-btn" href="components/logout.php">
            <span class="fas fa-key"></span>
            Logout
            </a>
            </li>';

        // adding the btns for logged in users
        $userBtn = '<ul class="user-btn-container">
            
            <li>
            <a class="nav-btn user-btn">
            <span class="fas fa-user"></span>
            Anurag
            </a>
            </li>
            </ul>';


        echo $inboxBtn, $sendmailBtn, $writeMailBtn, $logoutBtn, $userBtn;
    } else {
        // adding the btns for new users

        // html for sign up btn
        $signUpBtn = '<li>
            <a class="nav-btn" href="signUp.php">
            <span class="fas fa-user-plus"></span>
            Sign Up
            </a>
            </li>';

        // html for login btn
        $loginBtn = '<li>
            <a class="nav-btn" id="nav-login-btn">
            <span class="fas fa-key"></span>
            Login
            </a>
            </li>';
        // adding the btn into navbar
        echo $signUpBtn, $loginBtn;
    }

    ?>

</ul>
<div class="message" id="message-container">
</div>
<!-- Login Modal -->
<div class="modal-container" id="login-modal">

    <form method="POST" action="components/login.php" class="modal">
        <div class="modal-title">
            Login Modal
        </div>
        <div class="modal-content">
            <input type="text" name="email" id="email" placeholder="Enter Your Email">
            <input type="password" name="password" id="password" placeholder="Enter Your Password">
        </div>
        <div class="modal-footer">
            <button type="submit">Login</button>
            <button type="button" id='close-login-modal'>Close</button>
        </div>

    </form>
</div>

<script src="static/JS/base.js"></script>

<script>
    function showMessage(msg) {
        var msgContainer = document.getElementById('message-container');
        msgContainer.style.display = 'block';
        msgContainer.innerHTML = msg;
        setTimeout(() => {
            msgContainer.style.display = 'none';
        }, 2000);

    }
</script>


<?php
echo '<script>showMessage("' . $_GET['msg'] . '");</script>';
?>
