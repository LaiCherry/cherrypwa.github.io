<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; //與模型關聯的資料表
    protected $primarykey = "id"; //自行定義資料庫中的主鍵，預設為"id"
    public $timestamps = false; //說明模型是否應該被戳記時間，created_at跟updated_at
    /*protected $fillable = [ //白名單，允許mass assignment
        'name', 'email'
    ];
    protected $guarded = ['id', 'password'];*/

    public function articles(){
        return $this->hasMany('App\Models\Article', 'user_id');
    }
}
