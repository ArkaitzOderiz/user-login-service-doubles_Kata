<?php

namespace UserLoginService\Doubles;

use UserLoginService\Application\SessionManager;

class FakeSessionManager implements SessionManager
{
    public function login(string $userName, string $password): bool
    {
        if($password == "pass" && $userName == "name"){
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