<?php

namespace App\Domain\Users\Controllers;

use App\Domain\Users\Requests\UserRequest;
use App\Domain\Users\Requests\BookmarkRequest;
use App\Domain\Users\Services\CreateUserService;
use App\Domain\Users\Services\CreateBookmarkService;
use App\Domain\Users\Services\DeleteBookmarkService;
use App\Domain\Shared\Traits\ExecuteService;
use App\Http\Controllers\Controller;
use Infrastructure\Users\Repositories\UserRepository;

class UserController extends Controller
{
    use ExecuteService;

    public function store(UserRequest $request, CreateUserService $service)
    {
        $user = $this->execute($service, $request->all());
        return response($user, 201);
    }

    public function bookmarks()
    {
        $repository = resolve(UserRepository::class);
        
        $bookmarks = $repository->findBookmarksByUser(auth()->user());

        return response($bookmarks);
    }

    public function storeBookmark(BookmarkRequest $request, CreateBookmarkService $service)
    {
        $bookmark = $this->execute($service, $request->all());
        return response()->noContent(201);
    }

    public function deleteBookmark($id, DeleteBookmarkService $service)
    {
        $bookmark = $this->execute($service, $id);
        return response()->noContent();
    }
}
