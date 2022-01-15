<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /** @var Plan */
    private $repository;

    public function __construct(Plan $plan)
    {
        parent::__construct();

        $this->repository = $plan;

        $this->breadcrumb
            ->base(route('admin.index'), 'Dashboard')
            ->addCrumb('Planos', route('plans.index'));

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.plans.index', [
            'plans' => $this->repository->latest()->paginate(),
            'breadcrumb' => $this->breadcrumb,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.plans.create', [
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Novo Plano', '#'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdatePlanRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUpdatePlanRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     */
    public function show($slug)
    {
        $plan = $this->repository->where('slug', $slug)->first();
        if (!$plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.show', [
            'plan' => $plan,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb($plan->name, '#'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     */
    public function edit($slug)
    {
        $plan = $this->repository->where('slug', $slug)->first();
        if (!$plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.edit', [
            'plan' => $plan,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Editar Plano', '#'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdatePlanRequest $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdatePlanRequest $request, $slug)
    {
        $plan = $this->repository->where('slug', $slug)->first();
        if (!$plan) {
            return redirect()->back();
        }

        $plan->update($request->all());

        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     */
    public function destroy($slug)
    {
        $plan = $this->repository
            ->with('planDetails')
            ->where('slug', $slug)
            ->first();

        if ($plan->planDetails->count()) {
            return redirect()->back()->with('error', 'Existem detalhes vinculados a esse plano, portanto não é possível deletar.');
        }

        if (!$plan) {
            return redirect()->back();
        }

        $plan->delete();

        return redirect()->route('plans.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $plans = $this->repository->search($request->search);

        return view('admin.pages.plans.index', compact('plans', 'filters'));
    }
}
