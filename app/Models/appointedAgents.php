<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointedAgents extends Model
{   
    protected  $primaryKey = 'rocketMGA_id';
    public $incrementing = false;
    use HasFactory;
}
