<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Support\Faq\FaqStatus;

class Faq extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faqs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'answer', 'status', 'created_by'
    ];

    /**
     * Functions
     *
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function labelClass()
    {
        switch($this->status) {
            case FaqStatus::PUBLISHED:
                $class = 'success';
                break;

            case FaqStatus::NOTPUBLISHED:
                $class = 'danger';
                break;

            default:
                $class = 'warning';
        }

        return $class;
    }


    /**
     * Relationships
     *
     */
    public function user()
    {
        return $this->hasOne(User::class, 'created_by');
    }
}
