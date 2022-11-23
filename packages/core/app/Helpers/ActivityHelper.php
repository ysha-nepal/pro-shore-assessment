<?php

namespace Core\Helpers;

use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ActivityHelper
{
    public function __construct(Activity $model)
    {
        $this->model = $model;
    }

    public function get()
    {
        $user = Auth::user();
        return $this->model->where('causer_type', 'Core\Models\User')->where('causer_id', $user->id)->limit(5)->latest('created_at')->get();
    }

    public function getEventsDropdown()
    {
        return $this->model->pluck('event','event')->prepend('Select Event','');
    }
}
