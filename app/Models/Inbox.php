<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inbox extends Model
{
    use HasFactory;
    use Searchable;

    const CODE = 'IMPO';
    const NAME = 'وارد';
    public static function link($id)
    {
        return route('inboxes.show', $id);
    }
    protected $fillable = [
        'number',
        'registered_at',
        'issued_at',
        'sender',
        'receiver',
        'subject',
        'type',
        'company_status',
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
        return self::CODE. "/" .now()->year. "/" .self::getNewCode();
    }

    public static function getNewCode() : int 
    {
        return self::whereYear('created_at', now()->year)->latest()->limit(1)->get()->first()->id + 1;
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
            
            $model->number = self::GetFullCode();
            $model->save();    
        });
    }

}
