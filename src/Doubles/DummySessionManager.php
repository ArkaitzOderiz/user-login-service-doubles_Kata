<?php

namespace UserLoginService\Doubles;

use UserLoginService\Application\SessionManager;

class DummySessionManager implements SessionManager
{
    public function login(string $userName, string $password): bool
    {
        throw new Exception('This should not be used');
    }

    public function getSessions(): int
    {
        throw new Exception('This should not be used');
    }
}