



<style>
  *{
   
    background-color:#010066;
    
    
  }

     .Todo{
      width:60%;
    margin:150px auto;
    border:1px solid grey;
    border-radius:20px;
    overflow:hidden;
    background-color:white;
    
  
   

     }

  .Todolist{
  
    width:100%;
     background-color:white;
    
  }
 
  .Todo-head{
      background-color:white;
      display:flex;
  }

  .login{
     background-color:white;
  }

  ul{
    background-color:white;
  }

  li{
    background-color:white;
  }

  table{
  
    
    background-color:white;
  }

  table tr th{
    background-color:white;
  }

  table tr td{
    background-color:white;
    text-align:center;
    padding:10px 0px;
  
  }

 

  h1{
    background-color:white;
    padding-left:5%;
   
  }

  .form1{
    width:100%;
    background-color:white;
    display:flex;
  }

  .text1{
    width:80%;
    height:40px;
    background-color:white;
   margin-left:3%;
   border:1px solid grey;
   border-radius:5px;
  }

  .btn1{
    margin-left:5%;
    height:40px;
    width:10%;
    background-color:white;
    border:3px solid #c450a0;
    border-radius:5px;
    color:#c450a0;
  }

  table{
    width:100%;
  }

  .btn2{
    width:80%;
    border:3px solid orange;
    color:orange;
    font-weight:bold;
    border-radius:5px;
    background-color:white;
    height:40px;
    margin:0px 10px;

  }

  .text2{
   width:95%;
   background-color:white;
   border:2px solid grey;
   border-radius:5px;
   height:24px;
  }

  .btn3{
    width:80%;
    border:3px solid #00a497;
    border-radius:5px;
    font-weight:bold;
    background-color:white;
    color:#00a497;
    height:40px;
   margin:0px 10px;
  }

  .log{
     background-color:white;
     display:flex;
  }

  .login{
    background-color:white;
  }

  .select{
    background-color:white;
  }

  .selectTag{
    background-color:white;
  }

   
  
  
 
  
  

</style>
<div class="Todo">
  <div class="Todolist">
    <div class="Todo-head">
      <h1>Todo List</h1>
      <div class="log">
        @if(Auth::check())
        <p class="login">{{"「".$user->name."」"."でログイン中"}}</p>
        @else
        <p>ログインしてください（<a href="/login">ログイン</a>
        <a href="/register">登録</a>）</p>
        @endif
        <a href="/logout">ログアウト</a>
      </div>
    </div>
    <a href="/todo/find">タスク検索</a>

     
      
      @if(count($errors)>0)
       <ul>
        @foreach($errors->all() as $error)
         <li>{{$error}}</li>
        @endforeach
       </ul>
         
      @endif
      
      <form action="todo/create" class="form1" method="post">
       
        @csrf
        <input type="text" class="text1"  name="content">
        <select name="tag_id" class="select">
          
          @foreach($items2 as $item2)
          <option value="{{$item2->id}}" class="selectTag">{{$item2->tagName}}</option>
          @endforeach
        </select>
        <input type="submit"  class="btn1" name="add" value="追加">

      </form>
    </div>
    <table>
      <tr>
        <th>作成日</th>
        <th>タスク名</th>
        <th>タグ</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      @foreach($items as $item)
      <tr>
     
        <td>{{$item->created_at}}</td>
     
        <form action="/todo/update" method="post" >
        @csrf
        <td>
          <input type="text"  class="text2" name="content"  value="{{$item->content}}">
       
        </td>
        <td>
          <select name="tag_id" class="select">
            @foreach($items2 as $item2)
              @if($item2->tagName==$item->tag->tagName)
              <option value="{{$item2->id}}" class="selectTag" selected>{{$item->tag->tagName}}</option>
              @else
              <option value="{{$item2->id}}" class="selectTag" >{{$item2->tagName}}</option>
              @endif
            @endforeach
           
          
              
            
            
          </select>
        <td>
          <input type="submit" class="btn2" value="更新">
          <input type="hidden" name="id" value="{{$item->id}}">
        </td> 
        
        </form>
        
        <form action="/todo/delete" method="post">
         @csrf

        <td>
          <input type="submit" class="btn3" value="削除">
          <input type="hidden" name="id" value="{{$item->id}}">
        </td>
    
        </form>
        

      </tr>
      @endforeach
 
    </table>
  </div>
</div>
