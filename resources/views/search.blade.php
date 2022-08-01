<style>
  *{
    background-color:blue;
  }
</style>
<div class="search">
  <div class="search-content">
    <div class="search-header">
      <h2>タスク検索</h2>
      @if(Auth::check())
        <p class="login">{{"「".$user->name."」"."でログイン中"}}</p>
       @endif
      <a href="/logout">ログアウト</a>
    </div>
    <form action="/todo/search" method="post">
      @csrf
      <input type="text" name="content">
      <select name="tag_id">
        <option value="" selected></option>
        @foreach($items2 as $item2)
        <option value="{{$item2->id}}">{{$item2->tagName}}</option>
        @endforeach
      </select>
      <input type="submit" value="検索">
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
     
          <form action="/todo/update" method="post" >
          @csrf
          <td>
            <input type="text"  class="text2" name="content"  value="{{$item->content}}">
       
          </td>
          <td>
            <select name="tag_id">

           
              @foreach($items2 as $item2)
                @if($item2->tagName==$item->tag->tagName)
                <option value="{{$item2->id}}" selected>{{$item->tag->tagName}}</option>
                @else
                <option value="{{$item2->id}}" >{{$item2->tagName}}</option>
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
      <a href="/">戻る</a>

    </div>
  <div>
</div>

