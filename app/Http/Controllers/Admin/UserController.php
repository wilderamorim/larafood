<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /** @var User */
    private $repository;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->repository = $user;

        $this->breadcrumb
            ->base(route('admin.index'), 'Dashboard')
            ->addCrumb('Usuários', route('users.index'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.users.index', [
            'users' => $this->repository->thisTenant()->paginate(),
            'breadcrumb' => $this->breadcrumb,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.users.create', [
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Novo Usuário', '#'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUpdateUserRequest $request)
    {
        $data = $request->all();
        $data['tenant_id'] = Auth::user()->tenant_id;
        $data['password'] = bcrypt($request->password);

        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        if (!$user = $this->repository->thisTenant()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.show', [
            'user' => $user,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb($user->name, '#'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        if (!$user = $this->repository->thisTenant()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', [
            'user' => $user,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Editar Usuário', '#'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateUserRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StoreUpdateUserRequest $request, $id)
    {
        if (!$user = $this->repository->thisTenant()->find($id)) {
            return redirect()->back();
        }

        $data = $request->except('password');

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        if (!$user = $this->repository->thisTenant()->find($id)) {
            return redirect()->back();
        }

        if (Auth::user()->id == $user->id) {
            return redirect()->back();
        }

        $user->delete();

        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $users = $this->repository->thisTenant()->where(function ($query) use ($request) {
            if ($search = $request->search) {
                $query
                    ->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            }
        })->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }
}
