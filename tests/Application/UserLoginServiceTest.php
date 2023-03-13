<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use PHPUnit\Framework\TestCase;
use UserLoginService\Application\UserLoginService;
use UserLoginService\Domain\User;
use UserLoginService\Doubles\DummySessionManager;
use UserLoginService\Doubles\StubSessionManager;

final class UserLoginServiceTest extends TestCase
{
    /**
     * @test
     */
    public function errorIfUserIsAlreadyManuallyLoggedIn()
    {
        $userLoginService = new UserLoginService(new DummySessionManager());

        $user = new User("name");

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('user logged');

        $userLoginService->manualLogin($user);
        $userLoginService->manualLogin($user);
    }

    /**
     * @test
     */
    public function userIsManuallyLoggedIn()
    {
        $userLoginService = new UserLoginService(new DummySessionManager());

        $user = new User("name");

        $userLoginService->manualLogin($user);

        $this->assertContains($user, $userLoginService->getLoggedUsers());
    }

    /**
     * @test
     */
    public function returnExternalSessionsUsingStub()
    {
        $userLoginService = new UserLoginService(new StubSessionManager());

        $response = $userLoginService->getExternalSessions();

        $this->assertEquals("12", $response);
    }

    /**
     * @test
     */
    public function userIsCorrectlyLogged()
    {
        $userLoginService = new UserLoginService(new StubSessionManager());

        $response = $userLoginService->login("name", "pass");

        $this->assertEquals("Login correcto", $response);
    }

    /**
     * @test
     */
    public function userIsNotCorrectlyLogged()
    {
        $userLoginService = new UserLoginService(new StubSessionManager());

        $response = $userLoginService->login("name", "pass");

        $this->assertEquals("Login incorrecto", $response);
    }
}
