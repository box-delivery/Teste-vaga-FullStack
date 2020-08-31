@extends('layouts.base')
@section("content")
    <div class="headers">
        <h3>Movies List ({{$movies->total()}})</h3>
    </div>
    <div class="movies grey darken-2">
        <div class="section-header center-align white-text">
            <h4>Popular Movies</h4>
            <p>Some of actual popular movies</p>
        </div>
        <div class="row">
            @foreach($movies as $m)
                <div class="col m3 s12">
                    <div class="card grey darken-4 sticky-action">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="{{ $m['poster'] }}" alt="">
                        </div>
                        <div class="card-content">
                            <span class="card-title white-text truncate">{{ $m['name'] }}</span>
                        </div>
                        <div class="card-action">
                            @if(in_array($m['movie_id'], $favoriteMovies))
                                <a onclick='removeFromFavorites("{{$m['movie_id']}}")' class="tooltipped"
                                   data-position="bottom" data-tooltip="Remove from Favorites"><i
                                        class="material-icons">favorite</i></a>
                            @else
                                <a onclick='addToFavorites("{{$m['movie_id']}}")' class="tooltipped"
                                   data-position="bottom" data-tooltip="Add to Favorites"><i class="material-icons">favorite_border</i></a>
                            @endif
                            @if(!empty($m['home_page']))
                                <a href="{{$m['home_page']}}" target="_blank"><i class="material-icons">link</i></a>
                            @endif
                            <a class="activator"><i class="material-icons">info_outline</i></a>
                            @if(!empty($m["video"]))
                                <a href="https://youtube.com/watch?v={{$m['video']}}" target="_blank"><i
                                        class="material-icons">movie</i></a>
                            @endif
                        </div>
                        <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">{{ $m['name'] }}<i
                                        class="material-icons right">close</i></span>
                            <p>{{ $m['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <ul class="pagination">
            <li class="{{($movies->onFirstPage())? 'disabled' : 'waves-effect'}}"><a
                    href="{{ $movies->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a></li>
            @for($i=1;$i<=($movies->lastPage()); $i++)
                <li class="{{ ($movies->currentPage() == $i) ? 'active' : 'waves-effect' }}"><a
                        href="{{ $movies->url($i) }}">{{$i}}</a></li>
            @endfor
            <li class="{{($movies->currentPage() == $movies->lastPage())? 'disabled' : 'waves-effect'}}"><a
                    href="{{ $movies->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
        </ul>

        <p>Showing {{$movies->perPage()}} of {{ $movies->total() }} results</p>
    </div>
@endsection
