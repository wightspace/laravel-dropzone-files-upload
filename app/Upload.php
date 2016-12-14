<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'document_id',
        'name',
        'original_name',
        'extension',
        'path',
        'size',
    ];
}
