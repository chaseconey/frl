<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\MorphToActionTarget;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ActionEvent extends ActionResource
{
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id'),
            Text::make(__('Action Name'), 'name', function ($value) {
                return __($value);
            })->sortable(),

            Text::make(__('Action Initiated By'), function () {
                return $this->user->name ?? $this->user->email ?? __('Nova User');
            })->sortable(),

            MorphToActionTarget::make(__('Action Target'), 'target')->sortable(),

            Status::make(__('Action Status'), 'status', function ($value) {
                return __(ucfirst($value));
            })->loadingWhen([__('Waiting'), __('Running')])->failedWhen([__('Failed')]),

            $this->when(isset($this->original), function () {
                return KeyValue::make(__('Original'), 'original');
            }),

            $this->when(isset($this->changes), function () {
                return KeyValue::make(__('Changes'), 'changes');
            }),

            Textarea::make(__('Exception'), 'exception'),

            DateTime::make(__('Action Happened At'), 'created_at')->exceptOnForms()->sortable(),
        ];
    }

    /**
     * Determine if this resource is available for navigation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function availableForNavigation(Request $request)
    {
        return true;
    }
}
