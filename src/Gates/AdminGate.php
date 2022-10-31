<?php
namespace Bfe\Permission\Gates;
use Bfe\Permission\Contracts\Role;


class AdminGate
{
    public function isSysadmin($user){

        $role = Role::where('id',$user->role_id)->first();  
        return $role->slug === 'sysadmin' ? true : false;
    }

    public function isBusinessAdmin($user){
        
        $role = Role::where('id',$user->role_id)->first();     
        return $role->slug === 'business_admin' ? true : false;
    }
    
}
