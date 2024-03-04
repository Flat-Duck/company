<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intoutbox extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'number',
        'registered_at',
        'issued_at',
        'sender',
        'receiver',
        'subject',
        'company_status',
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
}
