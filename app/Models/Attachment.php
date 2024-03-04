<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'file',
        'extoutbox_id',
        'intoutbox_id',
        'inbox_id',
        'memo_id',
    ];

    protected $searchableFields = ['*'];

    public function extoutbox()
    {
        return $this->belongsTo(Extoutbox::class);
    }

    public function intoutbox()
    {
        return $this->belongsTo(Intoutbox::class);
    }

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }

    public function memo()
    {
        return $this->belongsTo(Memo::class);
    }
}
