<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->breadcrumb
            ->base(route('admin.index'), 'Dashboard')
            ->addCrumb('Permissões', route('permissions.index'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.permissions.index', [
            'permissions' => Permission::paginate(),
            'breadcrumb' => $this->breadcrumb,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.permissions.create', [
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Nova Permissão', '#'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdatePermissionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUpdatePermissionRequest $request)
    {
        Permission::create($request->all());

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     */
    public function show(Permission $permission)
    {
        return view('admin.pages.permissions.show', [
            'permission' => $permission,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb($permission->name, '#'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     */
    public function edit(Permission $permission)
    {
        return view('admin.pages.permissions.edit', [
            'permission' => $permission,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Editar Permissão', '#'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdatePermissionRequest $request
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function update(StoreUpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $permissions = Permission::where(function ($query) use ($request) {
            if ($search = $request->search) {
                $query
                    ->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            }
        })->paginate();

        return view('admin.pages.permissions.index', compact('permissions', 'filters'));
    }
}
