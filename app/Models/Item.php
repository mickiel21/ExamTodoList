<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\QueryFilter;
use App\Traits\HasFilter;
class Item extends Model
{
    use HasFilter , SoftDeletes;
    protected $fillable = ['name'];
}
