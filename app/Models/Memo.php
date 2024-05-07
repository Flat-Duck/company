<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Memo extends Model
{
    use HasFactory;
    use Searchable;

    const CODE = 'OTHE';
    const NAME = 'معاملات أخرى';

    public static function link($id)
    {
        return route('memos.show', $id);
    }
    
    protected $fillable = [
        'number',
        'registered_at',
        'issued_at',
        'type',
        'subject',
        'main_folder_id',
        'sub_folder_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'registered_at' => 'datetime',
        'issued_at' => 'datetime',
    ];

    public function mainFolder()
    {
        return $this->belongsTo(MainFolder::class);
    }

    public function subFolder()
    {
        return $this->belongsTo(SubFolder::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public static function GetFullCode() : string
    {
        return self::CODE. " / " .now()->year. " / " .self::getNewCode();
    }

    public static function getNewCode() : int 
    {
        $first =  self::whereYear('created_at', now()->year)->latest()->limit(1)->get()->first();
        
        if($first) {return $first->id + 1;}
        return 1;
    }
         /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            
            // $model->number = self::GetFullCode();
            // $model->save();

            $activity = new Activity();
            $activity->user_id = Auth::id();
            $activity->type = Activity::ADD;
            $activity->name = self::NAME;
            $activity->link = self::link($model->id);
            $activity->description = " قام " .Auth::user()->name. " ب".Activity::ADD." " .self::NAME. " بتاريخ " .$model->created_at->format('Y-d-m');
            $activity->save();
        });
    }
}
