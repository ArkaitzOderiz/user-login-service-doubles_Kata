<?php

namespace UserLoginService\Application;

use Exception;
use UserLoginService\Domain\User;
use UserLoginService\Infrastructure\FacebookSessionManager;

class UserLoginService
{
    private array $loggedUsers = [];
    private SessionManager $sessionManager;

    /**
     * @param SessionManager $sessionManager
     */
    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

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

    public function login(string $userName, string $password): string
    {
        if($this->sessionManager->login($userName, $password)){
            $user = new User($userName);
            $this->loggedUsers[] = $user;
            return "Login correcto";
        }
        return "Login incorrecto";
    }

    public function getExternalSessions(): int
    {
        return $this->sessionManager->getSessions();
    }

    /**
     * @return array
     */
    public function getLoggedUsers(): array
    {
        return $this->loggedUsers;
    }

}