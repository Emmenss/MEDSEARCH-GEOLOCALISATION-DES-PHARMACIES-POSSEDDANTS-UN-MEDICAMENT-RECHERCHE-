@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                  <form action="/user-profile" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    <!-- Champ pour le téléchargement de l'image -->
                    <div class="avatar avatar-xl position-relative">
                        <img src="data:image/png;base64,{{ auth()->user()->picture }}" alt="Profile Picture" id="profile-picture">
                    </div>
                 <div class="input-group">
                        <input type="file" class="form-control-file visually-hidden" id="picture" name="picture" accept="image/jpeg, image/png">
                        <label for="picture" class="input-group-text">
                            <span class="fa fa-edit edit-icon"></span>
                        </label>
                    </div>

                </div>
                <div class="col-auto my-auto offset-8">
                   
                   <h5 class="mb-1">
                   {{auth()->user()->name}} 
                   </h5>
                 
               </div>
            </div>

            
        </div>
    </div>

        <style>
              .input-group-text {
                    cursor: pointer;
                    background-color: #fff; /* Couleur de fond */
                    border: 1px solid #ced4da; /* Bordure */
                    border-left: 0; /* Suppression de la bordure à gauche */
                    padding: 0; /* Suppression du rembourrage */
                }

                .edit-icon {
                    font-size: 20px; /* Taille de l'icône */
                }

        </style>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                    @if($errors->any())
                    
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">{{ $errors->first() }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="user-name" name="name">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-phone" class="form-control-label">{{ __('Phone') }}</label>
                                <div class="@error('phone')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="tel" placeholder="40770888444" id="user-phone" name="phone" value="{{ auth()->user()->phone }}">
                                    @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-location" class="form-control-label">{{ __('Location') }}</label>
                                <div class="@error('location')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Location" id="user-location" name="location" value="{{ auth()->user()->location }}">
                                    @error('location')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="about">{{ 'About Me' }}</label>
                        <div class="@error('about_me')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about_me">{{ auth()->user()->about_me }}</textarea>
                            @error('about_me')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-lg">{{ 'Save Changes' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script JavaScript -->
<script>
    // Fonction pour mettre à jour l'image affichée lorsqu'une nouvelle image est choisie
    function updatePreviewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#profile-picture').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Événement onchange de l'input file
    $('#picture').on('change', function() {
        updatePreviewImage(this);
        // Masquer l'ancienne image
        $('#old-image').hide();
        // Afficher la nouvelle image choisie
        $('#profile-picture').show();
    });
</script>

@endsection
