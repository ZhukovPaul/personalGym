<?

namespace App\Traits;
use App\Models\Role;
use App\Models\Permission;

trait HasRolesAndPermissions
{
   
    public function roles()
    {
        return $this->belongsToMany(Role::class,"users_roles");
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,"users_permissions");
    }

    function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        return (bool)$this->permissions->where("slug",$permission)->count();    
    }
    
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission->slug);
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach($permission->roles as $role){
            if($this->roles->contains($role))
                return true;
        }
        return false;

    }
}