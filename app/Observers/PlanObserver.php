<?php

namespace App\Observers;

use App\Models\Plan;
use Illuminate\Support\Str;

class PlanObserver
{
    /**
     * Handle the Plan "creating" event.
     *
     * @param Plan $plan
     * @return void
     */
    public function creating(Plan $plan)
    {
        $plan->slug = Str::slug($plan->name);
    }

    /**
     * Handle the Plan "updating" event.
     *
     * @param Plan $plan
     * @return void
     */
    public function updating(Plan $plan)
    {
        $plan->slug = Str::slug($plan->name);
    }
}
