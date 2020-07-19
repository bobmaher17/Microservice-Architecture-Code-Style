<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDoModel extends Model
{
    protected $table = 'todo'; //table name that we made from migration is todo
    protected $fillable = ['id', 'activity', 'description'];
    protected $primaryKey = 'id';
    public $incrementing = false; //show UUID Response
}