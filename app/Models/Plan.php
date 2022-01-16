<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
    ];

    public function planDetails()
    {
        return $this->hasMany(PlanDetail::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_plan');
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function search(?string $search)
    {
        return $this
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->paginate();
    }

    public function unlinkedProfiles(?string $search = null)
    {
        return Profile::whereNotIn('profiles.id', function ($query) {
            $query
                ->select('profile_plan.profile_id')
                ->from('profile_plan')
                ->whereRaw("profile_plan.plan_id={$this->id}");
        })->where(function ($q) use ($search) {
            if ($search) {
                $q->where('profiles.name', 'LIKE', "%{$search}%");
            }
        })->paginate();
    }
}
