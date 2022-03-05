<?php



class Login  extends Dbh
{

    protected function getUser($uid, $pwd)
    {

        $sql = "SELECT pwd FROM users WHERE uid = ?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$uid])) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed1");
            exit();
        }



        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound1");
            exit();
        }

        $pwdHashed = $stmt->fetchAll();
        $checkPwd = password_verify($pwd, $pwdHashed[0]["pwd"]);

        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {

            $sql = "SELECT * FROM users WHERE uid = ?;";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute([$uid])) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed2");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt =  null;
                header("location: ../index.php?error=usernotfound2");
                exit();
            }

            $user = $stmt->fetchAll();
            session_start();
            $_SESSION["id"] = $user[0]["id"];
            $_SESSION["uid"] = $user[0]["uid"];
            $_SESSION["admin"]= $user[0]["uid"];
        }

        $stmt = null;
    }
}