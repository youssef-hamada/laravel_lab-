@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand text-white" href="#">ITI Blog</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="">All Posts</a>
              </li>
              
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">title</th>
            <th scope="col">Desc</th>
            <th scope="col">View</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
            <form action="">
                @foreach($posts as $post)
                        <tr> 
                            <td>{{$post->user_id}}</td>
                            <td>{{$post->name}}</td>
                            <td>{{$post->desc}}</td>
                            <td><a href="http://localhost/CRUD/CRUD/public/posts/view/{{$post->user_id}}"  class="btn btn-warning">View</a></td>
                            @can('update',$post)
                            <td><a href="http://localhost/CRUD/CRUD/public/posts/edit/{{$post->user_id}}"  class="btn btn-primary">Edit</a></td>
                            @else
                            <td><a href="#"  class="btn btn-primary">No</a></td>
                            @endcan
                            <td><a  data-route='#'  class="btn btn-dark del">Delete</a></td>
                            <td><a href="http://localhost/CRUD/CRUD/public/posts/userposts/{{$post->user_id}}"  class="btn btn-primary">All</a></td>
                            {{-- href="http://localhost/CRUD/CRUD/public/posts/delete/{{$post->name}}" --}}
                            {{-- <td><button type="button" class="btn btn-primary">edit</button></td> --}}
                            {{-- <td><button type="button" class="btn btn-dark">Delete</button></td> --}}
                            {{-- <td>$post[0]</td> --}}
                        </tr>
                @endforeach
                {{$posts->links('pagination::bootstrap-4')}}
        </form>
        </tbody>
      </table>

      <a class="btn btn-primary btn-lg" role="button" href="http://localhost/CRUD/CRUD/public/posts/add" aria-disabled="true">ِAdd post</a>
      <script type="text/javascript" defer>
          $btn =document.getElementsByClassName('del');
          console.log($btn);
          for(i = 0; i < $btn.length; i++){
            $btn[i].addEventListener('click', function(e){
              // console.dir(e.target.dataset.route);
              res = confirm("clicked")
              // console.log(res)
              if(res){
                e.target.href = "http://localhost/CRUD/CRUD/public/posts/delete/{{ $post->name }}";
                location.reload();
              }else{
                e.target.href = '#';
              }

            })

          }
            
      </script>
      {{-- @foreach ($posts as $post)
          <p>{{$post->id}}</p>
      @endforeach --}}
</body>
@endsection

</html>