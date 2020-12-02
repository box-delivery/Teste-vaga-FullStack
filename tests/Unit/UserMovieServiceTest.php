<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserMovieService;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\TestCase;

class UserMovieServiceTest extends TestCase
{
    public function testGetMoviesFromCurrentCustomer()
    {
        $userMock = $this->createMock(User::class);
        $userMock->method('__get')
            ->with('movies')
            ->willReturn(collect(['test']));

        Auth::shouldReceive('user')
            ->once()
            ->with()
            ->andReturn($userMock);

        $userMovieService = new UserMovieService();
        $movies = $userMovieService->getMoviesFromCurrentUser();

        $this->assertInstanceOf(Collection::class, $movies);
        $this->assertEquals(1, $movies->count());
    }

    public function testShouldAddMovieIfDoesntExist()
    {
        $movie_id = 3;

        $userMock = $this->createMock(User::class);
        $userMock->method('__get')
            ->with('movies')
            ->willReturn(collect([['id' => 1], ['id' => 2]]));

        $relationshipMock = $this->createMock(BelongsToMany::class);
        $relationshipMock->expects($this->once())
            ->method('attach')
            ->with($movie_id, [], true);

        $userMock->method('movies')
            ->willReturn($relationshipMock);

        Auth::shouldReceive('user')
            ->once()
            ->with()
            ->andReturn($userMock);

        $userMovieService = new UserMovieService();
        $result = $userMovieService->addMovieToCurrentUserList($movie_id);

        $this->assertTrue($result);
    }

    public function testShouldNotAddMovieIfExists()
    {
        $movie_id = 2;

        $userMock = $this->createMock(User::class);
        $userMock->method('__get')
            ->with('movies')
            ->willReturn(collect([['id' => 1], ['id' => 2]]));

        $relationshipMock = $this->createMock(BelongsToMany::class);
        $relationshipMock->expects($this->never())
            ->method('attach');

        $userMock->method('movies')
            ->willReturn($relationshipMock);

        Auth::shouldReceive('user')
            ->once()
            ->with()
            ->andReturn($userMock);

        $userMovieService = new UserMovieService();
        $result = $userMovieService->addMovieToCurrentUserList($movie_id);

        $this->assertTrue($result);
    }

    public function testShouldDeleteMovieIfExists()
    {
        $movie_id = 2;

        $userMock = $this->createMock(User::class);
        $userMock->method('__get')
            ->with('movies')
            ->willReturn(collect([['id' => 1], ['id' => 2]]));

        $relationshipMock = $this->createMock(BelongsToMany::class);
        $relationshipMock->expects($this->once())
            ->method('detach')
            ->with($movie_id, true);

        $userMock->method('movies')
            ->willReturn($relationshipMock);

        Auth::shouldReceive('user')
            ->once()
            ->with()
            ->andReturn($userMock);

        $userMovieService = new UserMovieService();
        $result = $userMovieService->deleteMovieFromCurrentUserList($movie_id);

        $this->assertTrue($result);
    }

    public function testShouldNotDeleteMovieIfDoesntExists()
    {
        $movie_id = 3;

        $userMock = $this->createMock(User::class);
        $userMock->method('__get')
            ->with('movies')
            ->willReturn(collect([['id' => 1], ['id' => 2]]));

        $relationshipMock = $this->createMock(BelongsToMany::class);
        $relationshipMock->expects($this->never())
            ->method('detach');

        $userMock->method('movies')
            ->willReturn($relationshipMock);

        Auth::shouldReceive('user')
            ->once()
            ->with()
            ->andReturn($userMock);

        $userMovieService = new UserMovieService();
        $result = $userMovieService->deleteMovieFromCurrentUserList($movie_id);

        $this->assertTrue($result);
    }

}
