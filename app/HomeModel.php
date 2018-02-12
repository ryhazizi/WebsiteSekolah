<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeModel extends Model
{
    protected $table = "siswa";
    public $timestamps = false;
    protected $fillable = ['nama','no_absen','kelas'];
}
