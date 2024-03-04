<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubFolder extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'main_folder_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sub_folders';

    public function mainFolder()
    {
        return $this->belongsTo(MainFolder::class);
    }

    public function inboxes()
    {
        return $this->hasMany(Inbox::class);
    }

    public function memos()
    {
        return $this->hasMany(Memo::class);
    }

    public function intoutboxes()
    {
        return $this->hasMany(Intoutbox::class);
    }

    public function extoutboxes()
    {
        return $this->hasMany(Extoutbox::class);
    }
}
