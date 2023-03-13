<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use PHPUnit\Framework\TestCase;
use UserLoginService\Application\UserLoginService;
use UserLoginService\Domain\User;
use UserLoginService\Doubles\DummySessionManager;

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
    public function testName()
    {

    }


}
