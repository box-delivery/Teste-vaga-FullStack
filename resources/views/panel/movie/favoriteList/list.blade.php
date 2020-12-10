<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="file_export" class="table table-striped table-bordered display responsive nowrap" width="100%">
                        <thead>
                        <tr>
                            <th style="width: 5%;">Imagem</th>
                            <th style="width: 20%;">Título</th>
                            <th style="width: 20%;">Criado</th>
                            <th style="width: 20%;">Popularidade</th>
                            <th style="width: 20%;">Votos</th>
                            <th style="width: 15%;">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($list as $item)
                                <tr>
                                    <th><img src="{{ $item->poster_path ? "https://image.tmdb.org/t/p/original/$item->poster_path" : asset("assets/img/default.png") }}" width="100px" height="150px"></th>
                                    <td class="align-middle">{{ $item->title ?? "-" }}</td>
                                    <td class="align-middle">{{ $item->release_date ?? "-" }}</td>
                                    <td class="align-middle">{{ $item->popularity ?? "-" }}</td>
                                    <td class="align-middle">{{ $item->vote_count ?? "-" }}</td>
                                    <td class="align-middle">
                                        <a title="Excluir da Lista de Favoritos" href="{{ route("panel.movie.deleteFavorite", ["movie_id"=>$item->id]) }}" class=""><i class="fa fa-heart fa-2x text-dark"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="6" class="text-danger text-center">Não há Lista de Favoritos para mostrar!!</th>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th style="width: 5%;">Imagem</th>
                            <th style="width: 20%;">Título</th>
                            <th style="width: 20%;">Criado</th>
                            <th style="width: 20%;">Popularidade</th>
                            <th style="width: 20%;">Votos</th>
                            <th style="width: 15%;">Ação</th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="text-center">{{ $list->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
