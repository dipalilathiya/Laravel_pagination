<form method="get">
    <input type="text" name="filter">
    <input type="submit">
 </form>
  <a href="{{route('logout')}}">logout</a>

<table border="1">
    <tr>
     <th>Id</th>
      <th>Name</th>
      <th>Contact</th>
      <th>Email</th>
      <th>password</th>
      <th>Delete</th>
      <th>update</th>
    </tr>
    @foreach ($data as $val)
         <tr>
              <td>{{$val->id}}</td>
              <td>{{$val->name}}</td>
              <td>{{$val->contact}}</td>
              <td>{{$val->email}}</td>
              <td>{{$val->password}}</td>
              <td><a href="/{{$val->id}}">delete</a></td>
              <td><a href="/update/{{$val->id}}">update</a></td>
         </tr>
    @endforeach
    <style>
       svg{
        height: 20px !important;
        width: 20px !important;
       }
    </style>
    {{$data->links()}}
</table>