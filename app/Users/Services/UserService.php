<?php

namespace App\Users\Services;

use App\App\Services\AbstractService;
use App\Contracts\CrudAware;
use App\Models\User;

class UserService extends AbstractService implements CrudAware
{
    public function getAll($role): UserService
    {
        if($role != null) {

            $users = User::where('role', '=', $role)->get();
        } else {
            $users = User::all();
        }

        $this->setResponseData($users->toArray());
        $this->addResponseMetadata('count', count($users));

        return $this;
    }

    /**
     * Create user
     *
     * @param $data
     * @return UserService
     */
    public function create($data): UserService
    {
        $user = User::create($data);
        $this->setResponseData($user->toArray());

        return $this;
    }

    /**
     * Show user
     *
     * @param $id
     * @return $this
     */
    public function show($id): UserService
    {
        $user = User::find($id);
        $this->setResponseData($user->toArray());

        return $this;
    }

    /**
     * Update user
     *
     * @param $id
     * @param $data
     * @return UserService
     */
    public function update($id, $data): UserService
    {
        $user = User::find($id);
        $user->update($data);
        $this->setResponseData($user->toArray());

        return $this;
    }

    /**
     * Delete user
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return User::find($id)->delete();
    }
}
