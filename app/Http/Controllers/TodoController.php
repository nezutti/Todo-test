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
   
   $items2=Tag::all();
   
   $item=["items2"=>$items2];
   
   return view("search",$item);
  }

public function search(Request $request){
    $s_content=$request->input('content');
    $s_tag_id=$request->input('tag_id');
    $items2=Tag::all();
    
    if(!empty($s_content)){
       $items=Todo::where('content','like',"%$s_content%")->get();
    }
    if(!empty($s_tag_id)){
        $items=Todo::where('tag_id',$s_tag_id)->get();
    }
    $param=["items"=>$items,"items2"=>$items2];
    return view("search",$param);
}

}