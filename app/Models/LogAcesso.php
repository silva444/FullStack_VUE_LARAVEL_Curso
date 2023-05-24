<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAcesso extends Model
{
    use HasFactory;

    protected $fillable=['log']; // permite que os registros sejam persistidos de modo massivo;
    //pelo metodo ::create();
}
