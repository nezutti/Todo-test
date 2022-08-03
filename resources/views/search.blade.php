<style>
  *{
   
    background-color:#010066;
      
   

    
    
  }


  
  .Todolist{
  
    width:90%;
    margin:0 auto;
     background-color:white;
    
  }
 
  .Todo-head{
      width:100%;
      background-color:white;
      display:flex;
      justify-content:space-between;
  }

     .search{
      width:60%;
    margin:150px auto;
    border:1px solid grey;
    border-radius:20px;
    overflow:hidden;
    background-color:white;
    
  
   

     }
     
     .search-content{
      width:90%;
      margin:0 auto;
     }

     .search-header{
      display:flex;
      justify-content:space-between;
      background-color:white;
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

 

  h2{
    background-color:white;
    
   
  }

  .form1{
    width:100%;
    background-color:white;
    display:flex;
    margin:0px;
    padding-bottom:20px;
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
     display:flex;
     
     
  }

  .login{
    background-color:white;
    padding-top:15px;
    margin-right:20px;
    
  }

  .tologin{
    background-color:white;
    padding-top:15px;
  }

  .logout{
    background-color:white;
    text-decoration:none;
    border:3px solid red;
    border-radius:5px;
    height:20%;
    margin-top:20px;
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
   

.return{
  background-color:white;
  margin:0px;
}


.return-link{
  background-color:white;
  display:block;
  width:70px;
  padding:10px 0px;
  border:3px solid grey;
  border-radius:5px;
  text-decoration:none;
  font-size:12px;
  text-align:center;
  color:grey;
  
}

/*marginでは余白の部分の色が背景色に変わることがあるのでpaddingを使って余白を作るor親要素にmargin:0pxを指定*/
</style>
<div class="search">
  <div class="search-content">
    <div class="search-header">
      <h2>タスク検索</h2>
      <div class="log">
      @if(Auth::check())
        <p class="login">{{"「".$user->name."」"."でログイン中"}}</p>
       @endif
        <a href="/logout" class="logout">ログアウト</a>
      </div>
    </div>
     @if(count($errors)>0)
       <ul>
        @foreach($errors->all() as $error)
         <li>{{$error}}</li>
        @endforeach
       </ul>
         
      @endif
    <form action="/todo/search" method="post" class="form1">
      @csrf
      <input type="text" name="content" class="text1">
      <select name="tag_id" class="select">
        <option value=""  class="selectTag" selected disabled></option>
        @foreach($items2 as $item2)
        <option value="{{$item2->id}}" class="selectTag">{{$item2->tagName}}</option>
        @endforeach
      </select>
      <input type="submit" value="検索" class="btn1">
    </form>  
    <div class="search-result">
      @if(@isset($items))
      <table>
        <tr>
          <th>作成名</th>
          <th>タスク名</th>
          <th>タグ</th>
          <th>更新</th>
          <th>削除</th>
        </tr>
        
        @foreach($items as $item)
        <tr>
     
          <td>{{$item->created_at}}</td>
     
          <form action="/todo/update" method="post" class="form2">
            @csrf
            <td>
              <input type="text"  class="text2" name="content"  value="{{$item->content}}">
       
            </td>
            <td>
              <select name="tag_id" class="select">

           
              @foreach($items2 as $item2)
                @if($item2->tagName==$item->tag->tagName)
                <option value="{{$item2->id}}" class="selectTag"selected>{{$item->tag->tagName}}</option>
                @else
                <option value="{{$item2->id}}" class="selectTag" >{{$item2->tagName}}</option>
                @endif
            
            
              @endforeach
            
              </select>
            </td>
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
      @endif
      <div class="return">
        <a href="/" class="return-link">戻る</a>
      </div>

    </div>
  <div>
</div>

