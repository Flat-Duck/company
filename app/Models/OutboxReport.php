<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutboxReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'registered_at',
        'issued_at',
        'sender',
        'receiver',
        'type',
        'subject',
        'company_status',
        'main_folder_id',
        'sub_folder_id',
        'created_at'
    ];
    
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

}
