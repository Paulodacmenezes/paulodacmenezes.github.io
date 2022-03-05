<?php

class SignupContr extends Signup
{
    private $uid;
    private $pwd;
    private $pwdrepeat;

    public function __construct($uid, $pwd, $pwdrepeat)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
    }

    public function signupUser()
    {
        if ($this->emptyInput() == false) {
            echo"Empty input!!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        if ($this->pwdMatch() == false) {
            header("location: ../index.php?error=passwordmatch");
            exit();
        }

        if ($this->uidTakenCheck() == false) {
            header("location: ../index.php?error=usertaken");
            exit();
        }

       $this->setUser($this->uid,$this->pwd);

    }



    private function emptyInput()
    {

        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdrepeat)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {

        if ($this->pwd !== $this->pwdrepeat) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function uidTakenCheck()
    {

        if (!$this->checkUser($this->uid)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
}