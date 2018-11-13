<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;
use App\Http\Models\Db\NoteModel;
use App\Http\Models\Db\BackgroundModel;

class NotesModel
{
  public function getNotesAndBackground(){

    $notes = DB::table("app_notes")
      ->select("app_notes.id", "n_text", "n_background", "b_content")
      ->leftJoin("app_background", "app_notes.n_background", "=", "app_background.id")
      ->get();

    $backgroundDBModel = new BackgroundModel();
    $background = $backgroundDBModel->all();

    return array("notes" => $notes, "background" => $background);
  }

  public function addBackground($background){
    $backgroundDBModel = new BackgroundModel();
    $backgroundDBModel->b_content = $background;
    $backgroundDBModel->save();
    return array("ok"=>true);
  }

  public function addNote(){

    $noteDBModel = new NoteModel();
    $noteDBModel->n_text = "new";
    $noteDBModel->n_background = 0;

    try{
      $noteDBModel->save();
      return array("id" => $noteDBModel->id, "n_text" => "", "n_background" => 0);
    } catch(Exception $e) {
      return array("error" => true);
    }
  }

  public function deleteNote($id){

    $noteDBModel = new NoteModel();
    try{

      $noteDBModel->destroy($id);
      return array("id" => $id);
    } catch (Exception $e) {
      return array("error" => true);
    }
  }

  public function updateNote($data){

    $noteDBModel = new NoteModel();
    try{

      $note = $noteDBModel->find($data["n_id"]);

      $note->n_text = $data["n_text"];
      $note->n_background = $data["n_background"];
      $note->save();
      return array("id" => $data["n_id"]);

    } catch (Exception $e) {
      return array("error" => true);
    }
  }
}