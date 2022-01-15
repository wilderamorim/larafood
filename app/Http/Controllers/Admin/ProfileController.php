<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->breadcrumb
            ->base(route('admin.index'), 'Dashboard')
            ->addCrumb('Perfis', route('profiles.index'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.profiles.index', [
            'profiles' => Profile::paginate(),
            'breadcrumb' => $this->breadcrumb,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.profiles.create', [
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Novo Perfil', '#'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUpdateProfileRequest $request)
    {
        Profile::create($request->all());

        return redirect()->route('profiles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     */
    public function show(Profile $profile)
    {
        return view('admin.pages.profiles.show', [
            'profile' => $profile,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb($profile->name, '#'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profile $profile
     */
    public function edit(Profile $profile)
    {
        return view('admin.pages.profiles.edit', [
            'profile' => $profile,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Editar Perfil', '#'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateProfileRequest $request
     * @param Profile $profile
     * @return RedirectResponse
     */
    public function update(StoreUpdateProfileRequest $request, Profile $profile)
    {
        $profile->update($request->all());

        return redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Profile $profile
     * @return RedirectResponse
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect()->route('profiles.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $profiles = Profile::where(function ($query) use ($request) {
            if ($search = $request->search) {
                $query
                    ->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            }
        })->paginate();

        return view('admin.pages.profiles.index', compact('profiles', 'filters'));
    }
}
