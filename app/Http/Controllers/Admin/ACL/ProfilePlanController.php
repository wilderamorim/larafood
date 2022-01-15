<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Plan;
use Illuminate\Http\Request;

class ProfilePlanController extends Controller
{
    /** @var Plan */
    protected $plan;

    /**  @var Profile */
    protected $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        parent::__construct();

        $this->plan = $plan;
        $this->profile = $profile;

        $this->breadcrumb
            ->base(route('admin.index'), 'Dashboard')
            ->addCrumb('Planos', route('plans.index'));
    }

    public function profilesIndex($planId)
    {
        if (!$plan = $this->plan->find($planId)) {
            return redirect()->back();
        }

        return view('admin.pages.profile_plan.profiles-index', [
            'plan' => $plan,
            'profiles' => $plan->profiles()->paginate(),
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Perfis: ' . $plan->name, '#'),
        ]);
    }

    public function profilesCreate(Request $request, $planId)
    {
        if (!$plan = $this->plan->find($planId)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        return view('admin.pages.profile_plan.profiles-create', [
            'plan' => $plan,
            'profiles' => $plan->unlinkedProfiles($request->search),
            'filters' => $filters,
            'breadcrumb' => $this->breadcrumb
                ->addCrumb('Perfis: ' . $plan->name, route('profile_plan.profiles.index', ['plan' => $plan->id]))
                ->addCrumb('Novo', '#'),
        ]);
    }

    public function profilesStore(Request $request, $planId)
    {
        if (!$plan = $this->plan->find($planId)) {
            return redirect()->back();
        }

        if (!$request->profiles) {
            return redirect()->back()->with('error', 'É necessário escolher ao menos um perfil.');
        }

        $plan->profiles()->attach($request->profiles);

        return redirect()->route('profile_plan.profiles.index', ['plan' => $plan->id]);
    }

    public function profilesDestroy($planId, $profileId)
    {
        $plan = $this->plan->find($planId);
        $profile = $this->profile->find($profileId);

        if (!$plan || !$profile) {
            return redirect()->back();
        }

        $plan->profiles()->detach($profile);

        return redirect()->route('profile_plan.profiles.index', ['plan' => $plan->id]);
    }

    public function plansIndex($profileId)
    {
        if (!$profile = $this->profile->find($profileId)) {
            return redirect()->back();
        }

        return view('admin.pages.profile_plan.plans-index', [
            'profile' => $profile,
            'plans' => $profile->plans()->paginate(),
        ]);
    }

    public function plansDestroy($profileId, $planId)
    {
        $profile = $this->profile->find($profileId);
        $plan = $this->plan->find($planId);

        if (!$profile || !$plan) {
            return redirect()->back();
        }

        $profile->plans()->detach($plan);

        return redirect()->route('profile_plan.plans.index', ['profile' => $profile->id]);
    }
}
