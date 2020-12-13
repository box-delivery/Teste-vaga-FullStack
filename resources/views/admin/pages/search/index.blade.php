@extends('admin.layouts.app')

@section('title', 'Search - Github')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    .linha-vertical {
        height: 12px;        
        border-left: 2px solid;       
        margin-right: 1%;
        margin-left: 1%;
    }
</style>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Busca por Filmes
        </div>        
        <div class="card-body">
            <h5 class="card-title">Busca por Filmes por genero</h5>
            <form class="form-inline" action="{{ route('home.searchTerm') }}" method="GET">
                @csrf                
                <div class="linha-vertical"></div>
                <div class="form-group mx-sm-3 mb-2">
                    <select class="form-control" name="genero" id="genero">
                    @foreach($dados as $dado)
                        <?php 
                        if (($dado['name'] == "Romance")||($dado['id'] == "10749")) {
                            echo '<option value="1">Heróis</option>';
                        } else {
                            echo '<option value="'.$dado['id'].'">'.$dado['name'].'</option>';
                        }   
                        ?>
                    @endforeach
                    </select>
                </div>
                <div class="linha-vertical"></div>                
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>
            </form>
        </div>
    </div>

    <hr>
    <h2 class="mb-6">Busca no TMDB</h2> <!-- AQUI -->
    <table class="table table-hover movie-datatable" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>nome</th>
                <th>descrição</th>
                <th>language</th>
                <th>Imagem</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

    var $a = jQuery.noConflict()
    $a.fn.dataTable.ext.errMode = 'throw';
    $a(function() {

        var table = $a('.movie-datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth : false,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description',
                    width: '250px'
                },
                {
                    data: 'language',
                    name: 'language'
                },
                {
                    data: 'image',
                    render: function(data, type, row) {
                            return '<img src="'+data+'" /><p style="visibility:hidden; font-size: 1px">'+data+'</p>';
                    },
                    name: 'image',
                    width: '50px'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
        });
    });

    function cadastrar() {        
        $a('.movie-datatable tbody td').on('click', function() {
            let $row = $(this).closest("tr"),
                $tds = $row.find("td");

            dados = [];
            $.each($tds, function() {
                dados.push($(this).text());
            });
            console.log(dados);
            let nome = dados[1];
            let language = dados[3];
            let image = dados[4];
            let _token   = $('meta[name="csrf-token"]').attr('content');
           

            $.ajax({
                type: 'POST',
                url: "users/tagCreate",
                data: {
                    nome: nome,
                    language: language,
                    image: image,                    
                    _token: _token
                },
                success: function(data) {
                    alert('Favoritado com SUCESSO');
                }
            });

        });

    }
</script>


@endsection