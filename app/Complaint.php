<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    //Table Name
    protected $table = 'complaints';

    //Primary Key
    public $primaryKey = 'id';
    
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
