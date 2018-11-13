<?php

namespace App\Http\Models\Db;

use Illuminate\Database\Eloquent\Model;

class BackgroundModel extends Model{

  protected $table = "app_background";
  protected $fillable = array("b_content");

}