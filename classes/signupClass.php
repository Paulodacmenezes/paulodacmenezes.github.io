<?php

class Signup extends Dbh
{


    protected function setUser($uid, $pwd)
    {
        $sql = "Insert INTO users (uid,pwd) VALUES (?,?);";
        $stmt = $this->connect()->prepare($sql);

        $hasedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute([$uid, $hasedPwd])) {
            $stmt  = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }


    protected function checkUser($uid)
    {
        $sql = "SELECT uid FROM users Where uid = ?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$uid])) {
            $stmt  = null;
            header("location: ../index.php?error=stmtfail");
            exit();
        }


        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {

            $resultCheck = true;
        }

        return $resultCheck;
    }
}