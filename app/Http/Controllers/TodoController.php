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
     $findtodo=Todo::find($request->id);
     $findtodo->content=$request->content;
     $findtodo->tag_id=$request->tag_id;
     $findtodo->save();
     
      
    

      return redirect("/");
   
     

  }

  public function delete(Request $request){
     

      $todo=Todo::find($request->id);
      $todo->delete();
      
      return redirect("/");
  }


  public function find(){
    
     $search=$request->content;
     Todo::where('content','like',"%$search%")->get();
  }

}