<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbladmin extends Model
{
  
    protected $table = 'tbladmin';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = true;
    protected $fillable = ["id","name" ,"contact","password","email","created_at","updated_at"];
}
