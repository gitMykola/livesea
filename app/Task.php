<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'name','author_id','text','status','latitude','longitude'
    ];

    
    public function user()
    {
      return $this->belongsTo(User::class, 'author_id');
    }
}
