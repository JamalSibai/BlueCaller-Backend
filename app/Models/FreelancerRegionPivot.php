<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerRegionPivot extends Model
{
    protected $table = "freelancers_has_regions";
    use HasFactory;
}
