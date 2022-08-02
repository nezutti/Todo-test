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
   $user=Auth::user();
   $item=["user"=>$user,"items2"=>$items2];
   
   return view("search",$item);
  }

public function search(Request $request){
    $s_content=$request->content;
    $s_tag_id=$request->tag_id;
    $items2=Tag::all();
    $user=Auth::user();
    
    if(!empty($s_content) && !empty($s_tag_id)){
        $items=Todo::where('content','like',"%$s_content%")->where('tag_id',$s_tag_id)->get();
    }
    if(!empty($s_content) && empty($s_tag_id)){
         $items=Todo::where('content','like',"%$s_content%")->get();
    } 
    if(empty($s_content) && !empty($s_tag_id)){
        $items=Todo::where('tag_id',$s_tag_id)->get();
    }
  
    
   
    $param=["items"=>$items,"items2"=>$items2,"user"=>$user];
    return view("search",$param);


}

}
//1 content、tag_idそれぞれ分けて検索　tagの値が同じだったら、タスク名が違っても検索結果に表示されるようになっている//
//2 content,tag_id両方被っているで検索　タスク名が一致しているだけでは検索結果が表示されない//
//3 content,tag_id両方被りまたは、content被り、tag_id被りで検索　　タグが一致しなくても全部返ってくる//


//両方被ってる or　content被ってるけど、tag_idは空欄　or tag_idは被っていて、contenは空欄

//正しい方法は、入力されているinputの種類によって,ifで処理条件を分けるだった