@extends('layouts.base')
@section("content")
    <div class="headers">
        <h3>Favorite List ({{ (!empty($array)) ? count($favoriteMovies) : 0 }})</h3>
    </div>
    <div class="movies grey darken-2">
        <div class="section-header center-align white-text">
            <h4>Favorite Movies</h4>
            <p>Your favorite movies</p>
        </div>
        @if(!empty($array))
            <div class="row">
                @foreach($array as $movies)
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
                                           data-position="bottom" data-tooltip="Add to Favorites"><i
                                                class="material-icons">favorite_border</i></a>
                                    @endif
                                    @if(!empty($m['home_page']))
                                        <a href="{{$m['home_page']}}" target="_blank"><i class="material-icons">link</i></a>
                                    @endif
                                    <a class="activator"><i class="material-icons">info_outline</i></a>
                                    @if(!empty($m["video"]))
                                        <a href="https://youtube.com/watch?v={{$m['video']}}" target="_blank"><i class="material-icons">movie</i></a>
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
                @endforeach
            </div>
        @else
            <div class="container">
                <div class="row">
                    <div class="col s12 center-align white-text">
                        <h5>(0) Favorites..</h5>
                        <a class="btn waves-effect red darken-2" href="{{ route("movies") }}">Show movies</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
