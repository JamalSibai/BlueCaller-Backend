<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Connection extends Model
{
    protected $table = "connections";
    use HasFactory;

    public function UserInfo(){
        return $this->belongsTo(User::class, 'id');
    }
}
