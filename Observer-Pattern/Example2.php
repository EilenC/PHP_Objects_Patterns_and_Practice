<?php
class Login implements SplSubject{
    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;
    private $status = [];
    private $storage;

    function __construct()
    {  
       $this->storage = new SplObjectStorage();
    }
    function attach(SplObserver $observer)
    {
        $this->storage->attach($observer);
    }

    function detach(SplObserver $observer)
    {
        $this->storage->detach($observer);
    }

    function notify(){
        foreach($this->storage as $obs){
            $obs->update($this);
        }
    }

    function handleLogin($user,$pass,$ip){
        switch (rand(1,3)){
            case 1:
                $this->setStatus(self::LOGIN_ACCESS,$user,$ip);
                $ret = true;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS,$user,$ip);
                $ret = false;
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN,$user,$ip);
                $ret = false;
                break;
        }
        $this->notify();
        return $ret;
    }
    private function setStatus($status,$user,$ip){
        $this->status = [$status,$user,$ip];
    }
    function getStatus(){
        return $this->status;
    }
}

abstract class LoginObserver implements SplObserver{
    private $login;
    function __construct(Login $login)
    {
        $this->login = $login;
        $login->attach($this);
    }

    function update(SplSubject $subject)
    {
        if($subject === $this->login){
            $this->doUpdate($subject);
        }
    }

    abstract function doUpdate(Login $login);
}