<?php

namespace App\Nova;

use App\Enums\DriverEquipment;
use App\Enums\DriverType;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Driver extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Admin';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Driver::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
    ];

    public static $with = ['latestRace', 'division', 'user', 'f1Number', 'f1Team'];

    public function title()
    {
        return "{$this->name} | {$this->division->name}";
    }

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
            Text::make('Name')->sortable(),
            BelongsTo::make('User')->sortable()->nullable(),
            Select::make('Type')
                ->options(DriverType::asSelectArray())
                ->displayUsingLabels()
                ->sortable(),
            Select::make('Equipment')
                ->options(DriverEquipment::asSelectArray())
                ->displayUsingLabels()
                ->hideFromIndex()
                ->sortable(),
            BelongsTo::make('Division')->sortable(),
            BelongsTo::make('F1 Team', 'f1Team')->sortable(),
            BelongsTo::make('F1 Number', 'f1Number')->sortable(),
            Number::make('Steam Friend Code')->sortable(),
            Text::make('Latest Race', function () {
                if ($this->latestRace) {
                    $raceTime = $this->latestRace->created_at;
                    $color = $raceTime->greaterThan(now()->subWeeks(3)) ? 'green' : 'red';

                    return "<span class='whitespace-no-wrap' style='color: {$color}'>{$raceTime->diffForHumans()}</span>";
                } else {
                    return 'N/A';
                }
            })->onlyOnIndex()->asHtml(),
            DateTime::make('Created At')->format('YYYY-MM-DD')->sortable(),

            HasMany::make('Race Results', 'raceResults'),
            HasMany::make('Race Quali Results', 'qualiResults'),
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
        return [
            new \App\Nova\Filters\DriverType,
            new \App\Nova\Filters\Division,
        ];
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
