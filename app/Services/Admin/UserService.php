<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Eloquent\UserRepository;

class UserService
{
    /**
     * The Configuration repository instance.
     *
     * @var TicketRepository
     */

    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public  function findByID($collections = [], $id)
    {
        return $this->repository->find($collections, $id);
    }

    public function updateStatus($user_id, $status_code)
    {
        return User::whereId($user_id)->update([
            'status' => $status_code
        ]);
    }

    public function createOrUpdate($request)
    {
        $users = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) ?? Hash::make('password'),
            'department_id' => $request->department,
        ];
        if (!empty($request->user_id)) {
            $user = User::find($request->user_id);
            $this->repository->userUpdate($request->user_id, $users);
            DB::table('model_has_roles')->where('model_id', $request->user_id)->delete();
            $user->assignRole($request->role);
            return $user;
        } else {
            $user = $this->repository->userStore($users);
            $user->assignRole($request->role);
            return $user;
        }
    }
}
