<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    //
    protected $fillable = ['subject', 'body', 'type', 'active'];
}
