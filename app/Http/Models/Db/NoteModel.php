<?php

namespace App\Http\Models\Db;

use Illuminate\Database\Eloquent\Model;

class NoteModel extends Model{

  protected $table = "app_notes";
  protected $fillable = array("n_content", "n_background");

}