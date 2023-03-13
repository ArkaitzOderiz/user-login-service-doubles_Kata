<?php

namespace UserLoginService\Doubles;

use UserLoginService\Application\SessionManager;

class FakeSessionManager implements SessionManager
{

    private string $userName = "name";
    private string $password = "pass";

    public function login(string $userName, string $password): bool
    {
        if($this->password == $password && $this->userName == $userName){
            return true;
        }
        return false;
    }

    public function getSessions(): int
    {
        //Imaginad que esto en realidad realiza una llamada al API de Facebook
        return 12;
    }
}