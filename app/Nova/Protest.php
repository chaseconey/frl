<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use EricLagarda\NovaEmbed\NovaEmbed;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Protest extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Races';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Protest::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('Driver')->sortable()->readonly(),
            BelongsTo::make('Protested Driver', 'protestedDriver', \App\Nova\Driver::class)->sortable()->readonly(),
            BelongsTo::make('Race')->sortable()->readonly(),
            Text::make('Video Url', function () {
                $url = $this->video_url;

                return "<a href='{$url}'>{$url}</a>";
            })->asHtml(),
            NovaEmbed::make('Video', 'video_url')
                ->ajax()
                ->exceptOnForms(),

            Text::make('Status')->onlyOnIndex(),
            Text::make('Created', 'created_at')
                ->displayUsing(function($created) {
                    return $created->diffForHumans();
                })
                ->onlyOnIndex(),

            Textarea::make('Rules Breached')->readonly(),
            Textarea::make('Description')->readonly(),

            Textarea::make('Stewards Decision')->nullable(),

            DateTime::make('Created At')->onlyOnDetail(),
            DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
