<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /** @var Category */
    private $repository;

    public function __construct(Category $category)
    {
        parent::__construct();

        $this->repository = $category;

        $this->breadcrumb
            ->base(route('admin.index'), 'Dashboard')
            ->addCrumb('Categorias', route('categories.index'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.categories.index', [
            'categories' => $this->repository->paginate(),
            'breadcrumb' => $this->breadcrumb,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.categories.create', [
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Nova Cayegoria', '#'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUpdateCategoryRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.categories.show', [
            'category' => $category,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb($category->name, '#'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.categories.edit', [
            'category' => $category,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Editar Categoria', '#'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateCategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StoreUpdateCategoryRequest $request, $id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        $category->delete();

        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $categories = $this->repository->where(function ($query) use ($request) {
            if ($search = $request->search) {
                $query
                    ->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            }
        })->paginate();

        return view('admin.pages.categories.index', compact('categories', 'filters'));
    }
}
