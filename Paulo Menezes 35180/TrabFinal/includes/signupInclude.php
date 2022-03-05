<?php
if (isset($_POST["submit"])) {

    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    include "../classes/dbhClass.php";
    include "../classes/signupClass.php";
    include "../classes/SignupContr.php";

    $signup = new SignupContr($uid, $pwd, $pwdrepeat);
    //error handlers
    $signup->signupUser();

    header("location: ../index.php?error=none");
}