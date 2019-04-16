<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primarykey = "id";
    /*protected $fillable = [
        'user_id','title', 'created_at','updated_at'
    ];
    protected $guarded = ['id'];*/

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
