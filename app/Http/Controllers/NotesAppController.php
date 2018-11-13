<?php

namespace App\Http\Controllers;
use App\Http\Models\NotesModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotesAppController extends Controller
{

  public function addBackground(Request $request){
    $noteModel = new NotesModel();
    $hexColor = $request->input("hex_color");
    return response($noteModel->addBackground($hexColor), 200)->header('Content-Type', "application/json");
  }

  public function notes()
  {
    $noteModel = new NotesModel();
    return response($noteModel->getNotesAndBackground(), 200)->header('Content-Type', "application/json");
  }

  public function addNote(Request $request)
  {

    $noteModel = new NotesModel();

    $return = $noteModel->addNote();
    $status = isset($return["error"]) ? 500 : 200;

    return response($return, $status)->header('Content-Type', "application/json");
  }

  public function editNote($id, Request $request)
  {

    $data = array(
      "n_id"          => (int)$id,
      "n_text"        => $request->input("text"),
      "n_background"  => $request->input("background")
    );

    $noteModel = new NotesModel();
    $return = $noteModel->updateNote($data);
    $status = isset($return["error"]) ? 500 : 200;

    return response($return, $status)->header('Content-Type', "application/json");
  }

  public function deleteNote($id)
  {
    $noteModel = new NotesModel();
    $return = $noteModel->deleteNote( (int)$id );
    $status = isset($return["error"]) ? 500 : 200;

    return response($return, $status)->header('Content-Type', "application/json");
  }
}
