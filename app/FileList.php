<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileList extends Model
{
    protected $fillable = [
        'user_id', 'file_id',
    ];
}
