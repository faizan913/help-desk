<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Services\Admin\UserService;
use App\Http\Controllers\Controller;
use App\Http\Traits\QueryTrait;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    use QueryTrait;

    /**
     * Create constructor.
     *
     * @return void
     */
    private $repository;
    private $service;

    public function __construct(UserRepositoryInterface $repository, UserService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Show users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $users = $this->repository->all(['roles', 'departments']);
            return view('admin.users.index', compact('users'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }
    /**
     * Create resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data['roles'] = Role::all()->pluck('name', 'id');
            $data['departments'] = $this->getDepartment();
            return view('admin.users.create', compact('data'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }
    /**
     * Store record
     *
     * @param  int UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $this->service->createOrUpdate($request);
            return redirect()->route('users.index')->with('success',  trans('message.record_saved'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        try {
            $roles = Role::all()->pluck('name', 'id');
            $depart = $this->getDepartment();
            $user = $this->service->findByID(['roles', 'departments'], $user->id);
            return view('admin.users.edit', compact('user', 'roles', 'depart'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Update existing records
     *
     * @param  UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $this->service->createOrUpdate($request);
            return redirect()->route('users.index')->with('success',  trans('message.record_updated'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
        //@codeCoverageIgnoreEnd 
    }

    /**
     * Delete User by user id.
     *
     * @return bool
     */
    public function destroy($id)
    {
        try {
            $this->repository->deleteById($id);
            return back()->with('delete',  trans('message.record_deleted'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }


    /**
     * Update user status.
     *
     * @param Integer $user_id
     * @param Integer $status_code
     * @return Success Response 
     */
    public function updateStatus($user_id, $status_code)
    {
        try {
            $this->service->updateStatus($user_id, $status_code);
            return redirect()->route('users.index')->with('user_blocked',  trans('message.user_blocked'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }
}
