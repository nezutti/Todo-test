<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{
  public function index(){
      $user=Auth::user();
      $items=Todo::with('tag')->get();
      $items2=Tag::all();
      $param=["items"=>$items,"user"=>$user,"items2"=>$items2];
      
      return view("index",$param);

  }

  public function create(Request $request){
      $this->validate($request,Todo::$rules);
      $form=$request->all();
      Todo::create($form);
      return redirect("/");

  }

  public function update(Request $request){
     $this->validate($request, Todo::$rules); 
     
     Todo::find($request->id);
     $form=$request->all();
      unset($form['_token']);
     Todo::where("id",$request->id)->update($form);

      return redirect("/");
   
     

  }

  public function delete(Request $request){
     

      $todo=Todo::find($request->id);
      $todo->delete();
      
      return redirect("/");
  }

}