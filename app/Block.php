<?php

namespace App;


use App\InstructorSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Block extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['course','no_of_enrolled','block_name','block_limit','level','status'];

    protected $events = [
        'updated' => UpdateBlock::class,
    ];

     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('created_at', function (Builder $builder) {
            $builder->orderBy('created_at');
        });
    }

    public function blockMatch(string $block) :int
    {
        $matchThese = [
            'level'      => $block[0],
            'course'     => $block[1] . $block[2],
            'block_name' => $block[3],
        ];
        return $this->where($matchThese)->first()->id;
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class,'block');
    }

    public function scopeOpen($query)
    {
        $query->where('status','open');
    }



}
