<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanDetailRequest;
use App\Models\Plan;
use App\Models\PlanDetail;
use Illuminate\Http\Request;

class PlanDetailController extends Controller
{
    /** @var PlanDetail */
    private $repository;

    /** @var Plan */
    private $plan;

    public function __construct(PlanDetail $planDetail, Plan $plan)
    {
        parent::__construct();

        $this->repository = $planDetail;
        $this->plan = $plan;

        $this->breadcrumb
            ->base(route('admin.index'), 'Dashboard')
            ->addCrumb('Planos', route('plans.index'));
    }

    public function index($slug)
    {
        if (!$plan = $this->plan->where('slug', $slug)->first()) {
            return redirect()->back();
        }

        $planDetails = $plan->planDetails()->paginate();

        return view('admin.pages.plan_details.index', [
            'plan' => $plan,
            'planDetails' => $planDetails,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb($plan->name, route('plans.show', ['plan' => $plan->slug]))
                ->addCrumb('Detalhes', '#'),
        ]);
    }

    public function create($slug)
    {
        if (!$plan = $this->plan->where('slug', $slug)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.plan_details.create', [
            'plan' => $plan,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb($plan->name, route('plans.show', ['plan' => $plan->slug]))
                ->addCrumb('Detalhes', route('plan_details.index', ['plan' => $plan->slug]))
                ->addCrumb('Novo Detalhe', '#'),
        ]);
    }

    public function store(StoreUpdatePlanDetailRequest $request, $slug)
    {
        if (!$plan = $this->plan->where('slug', $slug)->first()) {
            return redirect()->back();
        }

        $plan->planDetails()->create($request->all());

        return redirect()->route('plan_details.index', ['plan' => $plan->slug]);
    }

    public function show($slug, $detail)
    {
        $plan = $this->plan->where('slug', $slug)->first();
        $planDetail = $this->repository->find($detail);

        if (!$plan || !$planDetail) {
            return redirect()->back();
        }

        return view('admin.pages.plan_details.show', [
            'plan' => $plan,
            'planDetail' => $planDetail,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb($plan->name, route('plans.show', ['plan' => $plan->slug]))
                ->addCrumb('Detalhes', route('plan_details.index', ['plan' => $plan->slug]))
                ->addCrumb($planDetail->name, '#'),
        ]);
    }

    public function edit($slug, $detail)
    {
        $plan = $this->plan->where('slug', $slug)->first();
        $planDetail = $this->repository->find($detail);

        if (!$plan || !$planDetail) {
            return redirect()->back();
        }

        return view('admin.pages.plan_details.edit', [
            'plan' => $plan,
            'planDetail' => $planDetail,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb($plan->name, route('plans.show', ['plan' => $plan->slug]))
                ->addCrumb('Detalhes', route('plan_details.index', ['plan' => $plan->slug]))
                ->addCrumb('Editar Detalhe', '#'),
        ]);
    }

    public function update(StoreUpdatePlanDetailRequest $request, $slug, $detail)
    {
        $plan = $this->plan->where('slug', $slug)->first();
        $planDetail = $this->repository->find($detail);

        if (!$plan || !$planDetail) {
            return redirect()->back();
        }

        $planDetail->update($request->all());

        return redirect()->route('plan_details.index', ['plan' => $plan->slug]);
    }

    public function destroy($slug, $detail)
    {
        $plan = $this->plan->where('slug', $slug)->first();
        $planDetail = $this->repository->find($detail);

        if (!$plan || !$planDetail) {
            return redirect()->back();
        }

        $planDetail->delete();

        return redirect()
            ->route('plan_details.index', ['plan' => $plan->slug])
            ->with('message', 'Registro deletado com sucesso!');
    }
}
