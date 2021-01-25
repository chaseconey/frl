<?php

namespace App\Models;

use App\Notifications\ProtestReviewComplete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protest extends Model
{
    use HasFactory;

    protected $fillable = [
        "driver_id",
        "protested_driver_id",
        "race_id",
        "video_url",
        "description",
        "rules_breached"
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::updating(function ($protest) {
            $old = $protest->getOriginal();
            $new = $protest->getDirty();

            // If a decision is made, send notification to driver, but only the first time it is changed.
            if (
                is_null($old['stewards_decision']) &&
                array_key_exists('stewards_decision', $new) &&
                ! is_null($new['stewards_decision'])
            ) {
                /**
                 * @var \App\Models\User $user
                 */
                $user = Driver::find($old['driver_id'])->user;
                if ($user) {
                    $user->notify(new ProtestReviewComplete($protest));
                }
            }
        });
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function protestedDriver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
