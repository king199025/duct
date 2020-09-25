<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 16.10.18
 * Time: 16:48
 */

namespace App\Services\Users;


use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\ProfileRequest;
use App\Http\Requests\Users\SearchRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Repositories\Users\UserRepository;
use App\Http\Requests\Bot\BotRequest;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * Construct for User service
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Method for create user
     *
     * @param CreateRequest $request
     * @return User
     */
    public function create(CreateRequest $request): User
    {
        return $this->repository->create($request);
    }

    /**
     * Method for create bot
     *
     * @param BotRequest $request
     * @return User
     */
    public function createBot(BotRequest $request): User
    {
        return $this->repository->createBot($request);
    }

    /**
     * Method for update user
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return User
     */
    public function update(UpdateRequest $request, User $user): User
    {
        return $this->repository->update($request, $user);
    }

    /**
     * @param ProfileRequest $request
     * @param User $user
     * @return User
     */
    public function updateProfile(ProfileRequest $request, User $user): User
    {
        return $this->repository->updateProfile($request, $user);
    }

    /**
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        return $this->repository->destroy($user);
    }

    /**
     * @param SearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search(SearchRequest $request)
    {
        return $this->repository->findByEmailOrUsername($request->search_request,true)->paginate(20);
    }

}
