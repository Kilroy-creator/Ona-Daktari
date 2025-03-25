<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class roles extends Model
{
    use SoftDeletes;
    protected $table = 'roles';
    protected $fillable = ['name','slug', 'description'];
    public $timestamps = false;
}
