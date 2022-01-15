<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    /** @var Profile */
    protected $profile;

    /**  @var Permission */
    protected $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        parent::__construct();

        $this->profile = $profile;
        $this->permission = $permission;

        $this->breadcrumb
            ->base(route('admin.index'), 'Dashboard')
            ->addCrumb('Perfis', route('profiles.index'));
    }

    public function permissionsIndex($profileId)
    {
        if (!$profile = $this->profile->find($profileId)) {
            return redirect()->back();
        }

        return view('admin.pages.permission_profile.permissions-index', [
            'profile' => $profile,
            'permissions' => $profile->permissions()->paginate(),
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Permissões: ' . $profile->name, '#'),
        ]);
    }

    public function permissionsCreate(Request $request, $profileId)
    {
        if (!$profile = $this->profile->find($profileId)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        return view('admin.pages.permission_profile.permissions-create', [
            'profile' => $profile,
            'permissions' => $profile->unlinkedPermissions($request->search),
            'filters' => $filters,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Permissões: ' . $profile->name, route('permission_profile.permissions.index', ['profile' => $profile->id]))
                ->addCrumb('Nova', '#'),
        ]);
    }

    public function permissionsStore(Request $request, $profileId)
    {
        if (!$profile = $this->profile->find($profileId)) {
            return redirect()->back();
        }

        if (!$request->permissions) {
            return redirect()->back()->with('error', 'É necessário escolher ao menos uma permissão.');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('permission_profile.permissions.index', ['profile' => $profile->id]);
    }

    public function permissionsDestroy($profileId, $permissionId)
    {
        $profile = $this->profile->find($profileId);
        $permission = $this->permission->find($permissionId);

        if (!$profile || !$permission) {
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);

        return redirect()->route('permission_profile.permissions.index', ['profile' => $profile->id]);
    }

    public function profilesIndex($permissionId)
    {
        if (!$permission = $this->permission->find($permissionId)) {
            return redirect()->back();
        }

        return view('admin.pages.permission_profile.profiles-index', [
            'permission' => $permission,
            'profiles' => $permission->profiles()->paginate(),
        ]);
    }

    public function profilesDestroy($permissionId, $profileId)
    {
        $permission = $this->permission->find($permissionId);
        $profile = $this->profile->find($profileId);

        if (!$permission || !$profile) {
            return redirect()->back();
        }

        $permission->profiles()->detach($profile);

        return redirect()->route('permission_profile.profiles.index', ['permission' => $permission->id]);
    }
}
