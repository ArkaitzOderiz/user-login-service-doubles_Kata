<?php

namespace UserLoginService\Application;

use Exception;
use UserLoginService\Domain\User;
use UserLoginService\Infrastructure\FacebookSessionManager;

class UserLoginService
{
    private array $loggedUsers = [];

    /**
     * @throws Exception
     */
    public function
    manualLogin(User $user): void
    {
        if(in_array($user, $this->loggedUsers)) {
            throw new Exception('user logged');
        }

        $this->loggedUsers[] = $user;
    }

    public function getExternalSessions(): int
    {
        $facebook = new FacebookSessionManager();
        $rand = $facebook->getSessions();
        return $rand;
    }

    /**
     * @return array
     */
    public function getLoggedUsers(): array
    {
        return $this->loggedUsers;
    }

}