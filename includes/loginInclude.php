<?php
if (isset($_POST["submit"])) {
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    include "../classes/dbhClass.php";
    include "../classes/loginClass.php";
    include "../classes/loginContr.php";
    $login = new loginCtr($uid, $pwd);

    //error handler and user signin
    $login->loginUser();

    //frontpage
    header("location: ../index.php?error=none");
    
}