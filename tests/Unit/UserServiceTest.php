<?php

namespace Tests\Unit;

use App\Exceptions\UserAlreadyRegisteredException;
use App\Models\User as UserModel;
use App\Repositories\User as UserRepository;
use App\Services\UserService;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    public function testShouldThrowExceptionWhenCheckingForExistingUser()
    {
        $userRepositoryStub = $this->createStub(UserRepository::class);
        $userRepositoryStub->method('getUserByEmail')
            ->willReturn(new UserModel());

        $userService = new UserService($userRepositoryStub);

        $this->expectException(UserAlreadyRegisteredException::class);

        $userService->checkEmailNotInUse('test@test.com');
    }

    public function testShouldThrowExceptionWhenCreatingExistingUser()
    {
        $userRepositoryStub = $this->createStub(UserRepository::class);
        $userRepositoryStub->method('getUserByEmail')
            ->willReturn(new UserModel());

        $userService = new UserService($userRepositoryStub);

        $this->expectException(UserAlreadyRegisteredException::class);

        $userService->createUser('test', 'test@test.com', 'test');
    }

    public function testShouldReturnNullWhenCheckingEmailNotRegistered()
    {
        $userRepositoryStub = $this->createStub(UserRepository::class);
        $userRepositoryStub->method('getUserByEmail')
            ->willReturn(null);

        $userService = new UserService($userRepositoryStub);

        $return = $userService->checkEmailNotInUse('test@test.com');
        $this->assertEquals(true, $return);
    }
}
