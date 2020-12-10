<script>

    // Start List Genres
    function listGenres()
    {
        var searchGenres = $("select[name=searchGenres]");
        var htmlOptions = "<option value='not'>Mais Populares</option>";
        searchGenres.html(htmlOptions);
        $.ajax({
            url     : "{{ route("panel.genre.list") }}",
            method  : "GET",
            success : function (response)
            {
                $.each(response.data.list, function (key, genre){
                    htmlOptions += "<option value='"+genre.id+"'>"+genre.name+"</option>";
                });
                searchGenres.html(htmlOptions);
            },
            error : function (response)
            {
                console.log(response);
            },
        });
    }
    listGenres();
    // ------------------ End List Genres

    // Start Genre Change
    function changeGenre(element) {
        loadingSwal("Aguarde", "Carregando Lista de Filmes");
        listMoviesPopular(1);
    }
    // ----------------- End Genre Change

    // Start List Movies Populars
    function listMoviesPopular(page)
    {
        var list_movies_popular = $(".list-movies-popular");
        var searchGenres = $("select[name=searchGenres]");
        var htmlList = "" +
            "<div class='card text-center'>" +
            "<div class='card-header'>" +
            "Avisos" +
            "</div>" +
            "<div class='card-body'>" +
            "<h4 class='card-title'>Nenhum Filme para Listar!</h4>" +
            "<p class='card-text'>" +
            "Parece que não existem filmes para listar!" +
            "</p>" +
            "</div>" +
            "<div class='card-footer text-muted'>" +
            "</div>" +
            "</div>";
        $.ajax({
            url      : "/movie/list/"+searchGenres.val()+"?page="+page,
            method   : "",
            success  : function (response)
            {
                htmlList = "";
                if(response.status==="success")
                {
                    swal.close();
                    var last_page = response.data.list.last_page;
                    var current_page = response.data.list.current_page;
                    var paginate_list_movies = $(".paginate-list-movies");
                    var htmlLIs = "" +
                        "<li class='breadcrumb-item'>" +
                        "<i " +
                        "class='fa fa-arrow-left' " +
                        "style='cursor: pointer !important;' " +
                        "onclick='event.preventDefault();listMoviesPopular("+(current_page-1)+");'" +
                        ">" +
                        "</i>" +
                        "</li>";
                    if(current_page===1)
                    {
                        htmlLIs = "" +
                            "<li class='breadcrumb-item'>" +
                            "<i " +
                            "class='fa fa-arrow-left' " +
                            ">" +
                            "</i>" +
                            "</li>";
                    }
                    for(i=1;i<last_page;i++){
                        if(i <= current_page + 3 && i >= current_page - 3)
                        {
                            if(current_page===i)
                            {
                                htmlLIs += "<li " +
                                    "class='ml-2 mr-2 text-danger' " +
                                    ">"+i+"" +
                                    "</li>";
                            }
                            else
                            {
                                htmlLIs += "<li " +
                                    "class='ml-2 mr-2' " +
                                    "style='cursor: pointer !important;' " +
                                    "onclick='event.preventDefault();listMoviesPopular("+i+");'" +
                                    ">"+i+"" +
                                    "</li>";
                            }
                        }
                    }
                    if((current_page+1)===last_page)
                    {
                        htmlLIs += "" +
                            "<li class='breadcrumb-item'>" +
                            "<i " +
                            "class='fa fa-arrow-right' " +
                            ">" +
                            "</i>" +
                            "</li>";
                    }
                    else
                    {
                        htmlLIs += "" +
                            "<li class='breadcrumb-item'>" +
                            "<i " +
                            "class='fa fa-arrow-right' " +
                            "style='cursor: pointer !important;' " +
                            "onclick='event.preventDefault();listMoviesPopular("+(current_page+1)+");'" +
                            ">" +
                            "</i> " +
                            "</li><li>&nbsp &nbsp - Total de Páginas: ("+last_page+")</li>";
                    }
                    paginate_list_movies.html(htmlLIs);
                    $.each(response.data.list.data, function (key, movie){
                        var usersCount = movie.users.length;
                        var heartColor = "text-danger";
                        if(usersCount > 0)
                        {
                            heartColor = "text-dark";
                        }
                        var img = "/assets/img/default.png";
                        if(movie.poster_path!=null)
                        {
                            img = "https://image.tmdb.org/t/p/original"+movie.poster_path+"";
                        }
                        htmlList += "" +
                            "<div class='card card-movie' style='border: 1px dashed #606060;'>" +
                            "   <img class='card-img-top' src='"+img+"' alt='Card image cap'>" +
                            "   <div class='card-body'>" +
                            "       <h6 class='card-title'>"+movie.title+"</h6>" +
                            "   </div>" +
                            "   <div class='card-footer'>" +
                            "       <small class='text-muted'>" +
                            "           <i id='"+movie.id+"' title='Adicionar a Lista de Favoritos' class='fa fa-2x "+heartColor+" fa-heart class-favorite-icon' style='cursor: pointer !important;' onclick='event.preventDefault();clickFavorite(this)'></i>" +
                            "           <i id='"+movie.id+"' title='Ver Detalhes de Filme' class='fa fa-2x text-info fa-info-circle class-info-icon' style='cursor: pointer !important;' onclick='event.preventDefault();clickInfo(this)'></i>" +
                            "       </small>" +
                            "   </div>" +
                            "</div>" +
                            "<div class='clearfix'></div>";
                    });
                }
                list_movies_popular.html(htmlList);
            },
            error    : function (response)
            {
                console.log(response);
            },
        });
        list_movies_popular.html(htmlList);
    }
    listMoviesPopular();
    // ------------------ End List Movies Populars

    function clickFavorite(element) {
        $.ajax({
            url     : "/movie/favorite/"+$(element).attr("id"),
            method  : "GET",
            success : function (response)
            {
                if(response.status==="success")
                {
                    successSwal("Sucesso!", response.message);
                }
                else
                {
                    errorSwal("Sucesso!", response.message);
                }
            },
            error : function (response)
            {
                console.log(response);
            },
        });
    }

    function clickInfo(element) {
        $.ajax({
            url     : "/movie/info/"+$(element).attr("id"),
            method  : "GET",
            success : function (response)
            {
                if(response.status==="success")
                {
                    htmlInfo = "<ul>" +
                        "<li class='text-left'>Título : <span class='text-danger'>"+response.data.movie.title+"</span></li>" +
                        "<li class='text-left'>Título : <span class='text-danger'>"+response.data.movie.overview+"</span></li>" +
                        "<li class='text-left'>Linguagem : <span class='text-danger'>"+response.data.movie.original_language+"</span></li>" +
                        "<li class='text-left'>Popularidade : <span class='text-danger'>"+response.data.movie.popularity+"</span></li>" +
                        "<li class='text-left'>Médio de Votos : <span class='text-danger'>"+response.data.movie.vote_average+"</span></li>" +
                        "<li class='text-left'>Contagem de Votos : <span class='text-danger'>"+response.data.movie.vote_count+"</span></li>" +
                        "</ul>";
                    infoSwal("Informações", null, htmlInfo, false, true);
                }
                else
                {
                    errorSwal("Sucesso!", response.message);
                }
            },
            error : function (response)
            {
                console.log(response);
            },
        });
    }

    // Start List Genres Search
    function digitSearch()
    {
        var search = $("input[name=search]");
        var list_movies_popular = $(".list-movies-popular");
        var htmlList = "" +
            "<div class='card text-center'>" +
            "<div class='card-header'>" +
            "Avisos" +
            "</div>" +
            "<div class='card-body'>" +
            "<h4 class='card-title'>Nenhum Filme para Listar!</h4>" +
            "<p class='card-text'>" +
            "Parece que não existem filmes para listar!" +
            "</p>" +
            "</div>" +
            "<div class='card-footer text-muted'>" +
            "</div>" +
            "</div>";
        $.ajax({
            url     : "{{ route("panel.movie.search") }}",
            method  : "POST",
            data    : {
                _token : "{{ csrf_token() }}",
                search : search.val(),
            },
            success : function (response)
            {
                htmlList = "";
                if(response.status==="success")
                {
                    swal.close();
                    var last_page = response.data.list.last_page;
                    var current_page = response.data.list.current_page;
                    var paginate_list_movies = $(".paginate-list-movies");
                    var htmlLIs = "" +
                        "<li class='breadcrumb-item'>" +
                        "<i " +
                        "class='fa fa-arrow-left' " +
                        "style='cursor: pointer !important;' " +
                        "onclick='event.preventDefault();listMoviesPopular("+(current_page-1)+");'" +
                        ">" +
                        "</i>" +
                        "</li>";
                    if(current_page===1)
                    {
                        htmlLIs = "" +
                            "<li class='breadcrumb-item'>" +
                            "<i " +
                            "class='fa fa-arrow-left' " +
                            ">" +
                            "</i>" +
                            "</li>";
                    }
                    for(i=1;i<last_page;i++){
                        if(i <= current_page + 3 && i >= current_page - 3)
                        {
                            if(current_page===i)
                            {
                                htmlLIs += "<li " +
                                    "class='ml-2 mr-2 text-danger' " +
                                    ">"+i+"" +
                                    "</li>";
                            }
                            else
                            {
                                htmlLIs += "<li " +
                                    "class='ml-2 mr-2' " +
                                    "style='cursor: pointer !important;' " +
                                    "onclick='event.preventDefault();listMoviesPopular("+i+");'" +
                                    ">"+i+"" +
                                    "</li>";
                            }
                        }
                    }
                    if((current_page+1)===last_page)
                    {
                        htmlLIs += "" +
                            "<li class='breadcrumb-item'>" +
                            "<i " +
                            "class='fa fa-arrow-right' " +
                            ">" +
                            "</i>" +
                            "</li>";
                    }
                    else
                    {
                        htmlLIs += "" +
                            "<li class='breadcrumb-item'>" +
                            "<i " +
                            "class='fa fa-arrow-right' " +
                            "style='cursor: pointer !important;' " +
                            "onclick='event.preventDefault();listMoviesPopular("+(current_page+1)+");'" +
                            ">" +
                            "</i> " +
                            "</li><li>&nbsp &nbsp - Total de Páginas: ("+last_page+")</li>";
                    }
                    paginate_list_movies.html(htmlLIs);
                    $.each(response.data.list.data, function (key, movie){
                        var usersCount = movie.users.length;
                        var heartColor = "text-danger";
                        if(usersCount > 0)
                        {
                            heartColor = "text-dark";
                        }
                        var img = "/assets/img/default.png";
                        if(movie.poster_path!=null)
                        {
                            img = "https://image.tmdb.org/t/p/original"+movie.poster_path+"";
                        }
                        htmlList += "" +
                            "<div class='card card-movie' style='border: 1px dashed #606060;'>" +
                            "   <img class='card-img-top' src='"+img+"' alt='Card image cap'>" +
                            "   <div class='card-body'>" +
                            "       <h6 class='card-title'>"+movie.title+"</h6>" +
                            "   </div>" +
                            "   <div class='card-footer'>" +
                            "       <small class='text-muted'>" +
                            "           <i id='"+movie.id+"' title='Adicionar a Lista de Favoritos' class='fa fa-2x "+heartColor+" fa-heart class-favorite-icon' style='cursor: pointer !important;' onclick='event.preventDefault();clickFavorite(this)'></i>" +
                            "           <i id='"+movie.id+"' title='Ver Detalhes de Filme' class='fa fa-2x text-info fa-info-circle class-info-icon' style='cursor: pointer !important;' onclick='event.preventDefault();clickInfo(this)'></i>" +
                            "       </small>" +
                            "   </div>" +
                            "</div>" +
                            "<div class='clearfix'></div>";
                    });
                    if(response.data.list.data.length === 0)
                    {
                        htmlList = "" +
                            "<div class='card text-center'>" +
                            "<div class='card-header'>" +
                            "Avisos" +
                            "</div>" +
                            "<div class='card-body'>" +
                            "<h4 class='card-title'>Nenhum Filme para Listar!</h4>" +
                            "<p class='card-text'>" +
                            "Parece que não existem filmes para listar!" +
                            "</p>" +
                            "</div>" +
                            "<div class='card-footer text-muted'>" +
                            "</div>" +
                            "</div>";
                    }
                }
                list_movies_popular.html(htmlList);
            },
            error : function (response)
            {
                console.log(response);
            },
        });
    }
    // ------------------ End List Genres Search

</script>
