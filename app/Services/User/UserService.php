<?php
namespace App\Services\User;

use App\Models\User;
use App\Models\Role;

class UserService {
    private $user;
    private $role;

    public function __construct(Role $role,User $user){
        $this->user = $user;
        $this->role = $role;
    }
    public function create($request){
        foreach($request->role_user as $userItem){
            $roleIntance = $this->role->firstOrCreate([
                'name' => $userItem,
            ]);
            $roleIds[] = $roleIntance->id;
        }
        return $roleIds;
    }

}