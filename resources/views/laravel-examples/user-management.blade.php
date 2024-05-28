@extends('layouts.user_type.auth')

@section('content')

<div>
    <!-- <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Add, Edit, Delete features are not functional!</strong> This is a
            <strong>PRO</strong> feature! Click <strong>
            <a href="https://www.creative-tim.com/live/soft-ui-dashboard-pro-laravel" target="_blank" class="text-white">here</a></strong>
            to see the PRO product!
        </span>
    </div> -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5> 
                        </div>
                        <a href="#" id="add-admin-btn"  class="btn btn-success  btn-sm mb-0" type="button">+&nbsp; New User</a>
                        <div id="add-admin-form" style="display: none;"class="mx-auto">
                            <a id="button"  class="btn bg-gradient-primary btn-sm mb-0" type="button" style="position: absolute; top: 4%; left: 20%; cursor: pointer;">&larr;</a>
                            <form method="post" action="{{ route('adduser') }}" style="width: 400px">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon">
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                </div>
                                <div class="mb-3">
                                    <select name="profil" class="form-control">
                                        <option value="pharmacie" selected>Pharmacie</option>
                                        <option value="admin">Administrateurs</option>
                                        <option value="standard-user">Utilisateurs</option>
                                    </select>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="agreement" class="form-check-input" id="agreement">
                                    <label class="form-check-label" for="agreement">J'accepte les termes et conditions</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Add user</button>
                                </div>
                            </form>
                        </div>                    
                    </div>
                </div>       
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                        
                            <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->profil }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('deleteuser',['id'=>$user->id])}}" method="post">
                                          @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-danger"><i class="cursor-pointer fas fa-trash text-secondary"></i></button>
                                        </form>
                                     </td>
                                </tr>
                                    @endforeach 
                                
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Icons -->
<link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="../assets/css/nucleo-svg.css" rel="stylesheet" />

<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

<!-- CSS Files -->
<link id="pagestyle" href="../assets/css/soft-ui-dashboard.css" rel="stylesheet" />
<!-- CSS Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-q9oF9gaMm2Fds6l9fj0cfl3eO/8yo3g4gr+NUzBJs5lP1ZVwPq2A8F2wwj9p6UwD" crossorigin="anonymous">

<!-- JavaScript Bootstrap Bundle (includes Popper) CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-LdSgaQ8kpZYl99+h3e92gF3M+kLYWWc0woqAYiRtxfyczuUnxmdnHyUewlSzVfgF" crossorigin="anonymous"></script>


<!-- Core -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Assurez-vous que cet emplacement est correct, il peut varier en fonction de votre structure de projet -->

<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>

<!-- Theme JS -->
<script src="../assets/js/soft-ui-dashboard.min.js"></script>

<!--<script>
   
    document.getElementById("add-admin-btn").addEventListener("click", function() {
    // Inverser l'affichage de l'Ã©lÃ©ment #add-admin-form
    var form = document.getElementById("add-admin-form");
    form.style.display = (form.style.display === "block") ? "none" : "block";
});
   
</script>-->
<script>
    const addButton = document.getElementById('add-admin-btn');
    const formContainer = document.getElementById("add-admin-form");
    const backButton = document.getElementById('button');

    backButton.style.display = 'none'; // CachÃ© initialement

    // Ajouter le bouton de retour au formulaire
    formContainer.appendChild(backButton);

    addButton.addEventListener('click', function() {
        formContainer.style.display = 'block';
        addButton.style.display = 'none';
        backButton.style.display = 'block';
    });

    backButton.addEventListener('click', function() {
        formContainer.style.display = 'none';
        addButton.style.display = 'block';
        backButton.style.display = 'none';
    });
</script>

@endsection