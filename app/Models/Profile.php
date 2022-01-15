<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function unlinkedPermissions(?string $search = null)
    {
        return Permission::whereNotIn('permissions.id', function ($query) {
            $query
                ->select('permission_profile.permission_id')
                ->from('permission_profile')
                ->whereRaw("permission_profile.profile_id={$this->id}");
        })->where(function ($q) use ($search) {
            if ($search) {
                $q->where('permissions.name', 'LIKE', "%{$search}%");
            }
        })->paginate();
    }
}
