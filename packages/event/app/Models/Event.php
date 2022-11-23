<?php

namespace Event\Models;

use App\Models\User;
use Core\Models\BaseModel;
use Core\Models\Traits\HasMedia;
use Spatie\Translatable\HasTranslations;

/**
 * Class Event
 * @package Event\Models
 */
class Event extends BaseModel
{
    use HasMedia,HasTranslations;
    /**
     * @var string
     */
    protected $table = "events";
    /**
     * @var string[]
     */
    public $translatable = ['title','description'];
    /**
     * @var string[]
     */
    protected $fillable = [
        "title",
        "slug",
        "description",
        "start_date",
        "start_date_ad",
        "end_date",
        "end_date_ad",
        "created_by"
    ];

    /**
     * @var string[]
     */
    protected $appends = ['status'];

    /**
     * @var string[]
     */
    protected $casts = [
        'start_date_ad' => 'date',
        'end_date_ad' => 'date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        if(now()->between($this->start_date_ad,$this->end_date_ad)){
            return "Ongoing";
        }
        if($this->start_date_ad->gt(now())){
            return "Upcoming";
        }
        return "Finished";
    }
}
