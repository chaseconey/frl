<?php

namespace App\Nova;

use App\Service\F12020\UdpSpec;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class RaceQualiResult extends Resource
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
    public static $model = \App\Models\RaceQualiResult::class;

    public static $perPageViaRelationship = 20;

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

    public static $orderBy = ['lap_delta' => 'asc'];

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
            Number::make('Position')->sortable(),

            BelongsTo::make('Race'),
            BelongsTo::make('Driver'),
            BelongsTo::make('Team', 'f1Team', \App\Nova\F1Team::class),

            new Panel('Race Details', $this->raceDetailField()),
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

    private function raceDetailField()
    {
        return [
            Text::make('Best Lap Time')->sortable()->required(),
            Number::make('Lap Delta')->step(0.001)->sortable()->nullable(),
            Select::make('Best Lap Tire')->options([
                'S' => 'Soft',
                'M' => 'Medium',
                'H' => 'Hard',
                'W' => 'Wet',
                'I' => 'Inters'
            ])->nullable(),
            Select::make('Codemasters Result Status')
                ->options(UdpSpec::RACE_RESULT_STATUS)
                ->default(fn () => 3),

            Number::make('Best S1 Time')->step(0.001)->nullable()->hideFromIndex(),
            Number::make('Best S2 Time')->step(0.001)->nullable()->hideFromIndex(),
            Number::make('Best S3 Time')->step(0.001)->nullable()->hideFromIndex(),
            Number::make('Best S1 Delta')->step(0.001)->nullable()->hideFromIndex(),
            Number::make('Best S2 Delta')->step(0.001)->nullable()->hideFromIndex(),
            Number::make('Best S3 Delta')->step(0.001)->nullable()->hideFromIndex(),
        ];
    }
}
