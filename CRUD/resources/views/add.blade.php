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
          <a class="navbar-brand text-white" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      {{-- action="{{route('update')}}" --}}
        <form method="POST" action="http://localhost/CRUD/CRUD/public/posts/add" >
          @csrf 
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value='{{old('name')}}'>
            {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
            @error('name')
                <div class="alert alert-danger">it is required</div>
            @enderror
            {{-- @if($errors->any())
              <div class="alert alert-danger">it is required</div>
            @endif --}}
            {{-- {{$errors->all()}} --}}
            </div>
            <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Description</label>
            <input type="text" name="desc"  class="form-control @error('desc') is-invalid @enderror" id="exampleInputPassword1" value='{{old('desc')}}'>
            @error('desc')
                <div class="alert alert-danger">it is required</div>
            @enderror
            {{-- @if($errors->all())
              @foreach($errors->all() as $err)
                {{$err}}
              @endforeach
            @endif --}}
            </div>
            
            <a href="http://localhost/CRUD/CRUD/public/posts/"><button  class="btn btn-primary">Submit</button></a>
            {{-- {{$users[0]->name}}   type="submit" --}}
            <label for="users">Choose a user:</label>

            <select name="user" id="us">
              {{-- <option value="volvo">Volvo</option>
              <option value="saab">Saab</option>
              <option value="mercedes">Mercedes</option>
              <option value="audi">Audi</option> --}}
              @foreach($users as $user)
              <option value="{{$user->id}}"  selected>{{$user->name}}</option>
              @endforeach
            </select>

        </form>


        
      

</body>
</html>