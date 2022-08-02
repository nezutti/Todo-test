



<style>
  *{
   
    background-color:#010066;
      outline: 1px solid red !important;
  
   

    
    
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
  
    width:90%;
    margin:0 auto;
     background-color:white;
    
  }
 
  .Todo-head{
      background-color:white;
      display:flex;
      justify-content:space-between;
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
     
     
  }

  .login{
    background-color:white;
    
  }

  .logout{
    background-color:white;
    text-decoration:none;
    border:3px solid red;
    border-radius:5px;
    height:20%;
    margin-top:30px;
    margin-left:20px;
    padding:8px 5px;
    font-size:12px;
    width:80px;
    text-align:center;
     color:red;
     margin-left:0px;
  }
  

  .select{
    background-color:white;
    margin-left:30px;
    border:3px solid grey;
    border-radius:5px;
    width:60px;
    
  }

  .select2{
    background-color:white;
    border:3px solid grey;
    border-radius:5px;
  }

  .selectTag{
    background-color:white;
  }


  

  .task-find{
    background-color:white;
    text-decoration:none;
    display:block;
    border:3px solid green;
    border-radius:5px;
    width:10%;
    
    font-size:12px;
    color:green;
    padding:5px;
    margin:20px 0px;


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
        <p>ログインしてください（<a href="/login" class="login">ログイン</a>
        <a href="/register" class="login">登録</a>）</p>
        @endif
        <a href="/logout" class="logout">ログアウト</logout>
      </div>
      
    </div>
    <a href="/todo/find" class="task-find">タスク検索</a>

     
      
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
          <select name="tag_id" class="select2">
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
