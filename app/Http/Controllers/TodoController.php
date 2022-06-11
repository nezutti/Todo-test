<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Todo;

class TodoController extends Controller
{
  public function index(){
      $items=Todo::all();
      return view("index",["items"=>$items]);

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
