@extends('layouts.user_type.auth')

@section('content')



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre titre</title>
    <!-- Inclure jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Inclure DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- Inclure DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
<button  id="add-product-btn" class="btn btn-primary offset-9">  <i class="fa fa-plus"></i>  Ajouter produit</button>
       <div id="add-product-form" style="display: none;"class="mx-auto"> 
            <form id="meeting-send" method="post" action="{{ route('fileimported') }}" enctype="multipart/form-data" style="margin: 0 auto; max-width: 500px;">
                @csrf
                <label for="title">Fichier</label>
                <input type="file" class="form-control" name="filedata" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required><br>
                <button type="submit" class="btn btn-primary">Add file</button>
            </form>
        </div>



    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class=" titreprod text-uppercase  mb-4 offset-2">LISTE DES PRODUITS</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="authors-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary">Nom</th>
                                        <th class="text-uppercase text-secondary">Présentation</th>
                                        <th class="text-center text-uppercase text-secondary">Quantité</th>
                                        <th class="text-center text-uppercase text-secondary">Prix</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr>
                                            <td>{{ $file->name }}</td>
                                            <td>{{ $file->presentation }}</td>
                                            <td>{{ $file->prix }}</td>
                                            <td>{{ $file->quantite }}</td>
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
</main>

<!-- Inclure votre script DataTables -->
<script>
    document.getElementById("add-product-btn").addEventListener("click", function() {
        document.getElementById("add-product-form").style.display = "block";
    });

    $(document).ready(function() {
        $('#authors-table').DataTable({
            pagingType: 'simple_numbers', // Change pagination type to simple numbers
            pageLength: 5, // Nombre d'éléments par page
            language: {
                paginate: {
                    next: '&gt;', // Use '>' for next button
                    previous: '&lt;' // Use '<' for previous button
                }
            }
        });
    });
</script>
<style>
    .titreprod {
        display: inline-block;
        height: 40px;
        width: 70%;
        background-color: #c52790;
        border-radius: 8px;
        padding-top: 7px;
        text-align: center;
        color: white; /* Couleur du texte */
    }
</style>

</style>
  


@endsection
