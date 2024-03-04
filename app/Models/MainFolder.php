<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainFolder extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    protected $table = 'main_folders';

    public function subFolders()
    {
        return $this->hasMany(SubFolder::class);
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
