<?php

namespace Event\UI;

use Core\UI\BaseUI;
use Illuminate\Validation\Rule;

/**
 * Class EventUI
 * @package Event\UI
 */
class EventUI extends BaseUI
{
    /**
     * @var string
     */
    public $route = 'events';

    /**
     * @var string
     */
    public $title = "Events";

    /**
     * @var string[]
     */
    public $columns = [
        "title" => "Title",
        "start_date" => "Start Date",
        "end_date" => "End Date",
        "creator" => "Creator",
        "status" => "Status"
    ];

    /**
     * @var string[]
     */
    public $permissions = [
        'index' => 'Manage Events',
        'create' => 'Create Events',
        'edit' => 'Edit Events',
        'store' => 'Create Events',
        'update' => 'Edit Events',
        'destroy' => 'Delete Events',
        'status' => 'Edit Events'
    ];

    /**
     * @var array
     */
    public $with = ["creator"];

    /**
     * @return array[]
     */
    public function getActions()
    {
        return [
            'edit' => [
                'icon' => 'bi bi-pencil-square',
                'permission' => $this->permissions['edit'],
                'route' => "admin.$this->route.edit",
            ],
            'delete' => [
                'permission' => $this->permissions['destroy'],
                'route' => "admin.$this->route.destroy",
            ]
        ];
    }

    /**
     * @return array
     */
    public function createAction()
    {
        return [
            'permission' => $this->permissions['create'],
            'route' => "admin.$this->route.create"
        ];
    }

    /**
     * @var \string[][]
     */
    public $rules = [
        'store' => [
            'title' => 'array',
            'title.en' => 'required|string|max:255',
            'title.np' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:events',
            'description' => 'array',
            'description.en' => 'required|string:max:65535',
            'description.np' => 'nullable|string:max:65535',
            'start_date' => 'required|string|max:255',
            'start_date_ad' => 'required|date',
            'end_date' => 'required|string|max:255',
            'end_date_ad' => 'required|date|after_or_equal:start_date_ad'
        ],
        'update' => [
            'title' => 'array',
            'title.en' => 'required|string|max:255',
            'title.np' => 'nullable|string|max:255',
            'description' => 'array',
            'description.en' => 'required|string:max:65535',
            'description.np' => 'nullable|string:max:65535',
            'start_date' => 'required|string|max:255',
            'start_date_ad' => 'required|date',
            'end_date' => 'required|string|max:255',
            'end_date_ad' => 'required|date|after_or_equal:start_date_ad'
        ]
    ];

    /**
     * @return array|string[]
     */
    public function getUpdateRules($model)
    {
        $rules = $this->rules['update'];
        $rules['slug'] = [
            'required','string','max:255',Rule::unique('events')->ignore($model->id)
        ];
        return $rules;
    }

    public function creator($model)
    {
        return $model->creator->name;
    }

    public function status($model)
    {
        return view("event::admin.events.partials.status",['model' => $model]);
    }
}
