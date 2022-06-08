<style>

</style>

<h1>Todo List</h1>
<form action="todo/create" method="post">
  @csrf
  <input type="text" name="content">
  <input type="submit" name="add" value="追加">
</form>
<table>
  <tr>
    <th>作成日</th>
    <th>タスク名</th>
    <th>更新</th>
    <th>削除</th>
  </tr>
  @foreach($items as $item)
  <tr>
     
     <td>{{$item->created_at}}</td>
     
     <form action="/todo/update" method="post" >
       @csrf
     <td>
       <input type="text" name="content" value="{{$item->content}}">
       
     </td>
     <td>
       <input type="submit" value="更新">
       <input type="hidden" name="id" value="{{$item->id}}">
      </td> 
     <td>
       <form action="/todo/delete" method="post">
         @csrf

        <input type="hidden" name="id" value="{{$item->id}}">
        <input type="submit" value="削除">
            
       </form>
     </td>

  </tr>
  @endforeach
 
</table>

