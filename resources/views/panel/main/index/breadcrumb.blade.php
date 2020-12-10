<div class="row page-titles">
    <div class="col-md-6 align-self-center">
        <select class="form-control col-5 float-left" onchange="event.preventDefault();changeGenre(this);" id="searchGenres" name="searchGenres">
            <option value="not">Mais Populares</option>
        </select>
        <input type="text" name="search" class="form-control col-6 ml-4 float-left" onkeydown="digitSearch(this);" placeholder="Digite a palavra chave aqui ...">
    </div>
    <div class="col-md-6 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb paginate-list-movies"></ol>
        </div>
    </div>
</div>
