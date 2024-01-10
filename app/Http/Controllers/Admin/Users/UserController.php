<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $user;
    private $userservice;
    private $role;
    public function __construct(UserService $userservice, User $user,Role $role )
    {
        $this->userservice = $userservice;
        $this->role = $role;
        $this->user = $user;
    }
    public function index()
    {
        $users = $this->user->paginate(10);
        return view('admin.users.index',compact('users'));
    }
    public function create(){
        $roles = $this->role->all();
        return view('admin.users.add',compact('roles'));
    }
    public function store(Request $request){
        try {
            DB::beginTransaction();
            $users =$this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'confirm' => 1,

        ]);
        // $roleIds = $this->userservice->create($request);
        $users->roles()->attach($request->role_user);
        DB::commit();
        return redirect()->route('admin.users.create');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' -----Line:  ' . $e->getLine());
        }
        
    }

    public function edit($id){
        $roles = $this->role->all();
        $users = $this->user->find($id);
        $role_user = $users->roles;
        // dd($role_user);
        return view('admin.users.edit',compact('roles','users','role_user'));
    }
}