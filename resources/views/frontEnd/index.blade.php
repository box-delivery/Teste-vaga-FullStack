@extends("layouts.base")
@section("content")
    <header>
        <h3>Hello!</h3>
        <h5>Welcome to <strong>MovieFlix</strong>, your movie guide!</h5>
        <h6>Wakanda Forever</h6>
        <i class="material-icons">expand_more</i>
    </header>
    <section class="grey darken-3">
        <div class="section-header">
            <h4>Popular Movies</h4>
            <p>Some of actual popular movies</p>
        </div>
        <div class="section-content">
            <div class="row">
                @foreach($movies as $m)
                    <div class="col m3 s6">
                        <div class="card hoverable grey darken-4 sticky-action">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="{{ $m['poster'] }}" alt="">
                            </div>
                            <div class="card-content">
                                <span class="card-title truncate">{{ $m['name'] }}</span>
                            </div>
                            <div class="card-action">
                                @guest()
                                    <a href="{{ route('login') }}"><i class="material-icons">favorite_border</i></a>
                                @else
                                    @if(in_array($m['movie_id'], $favoriteMovies))
                                        <a onclick='removeFromFavorites("{{$m['movie_id']}}")' class="tooltipped"
                                           data-position="bottom" data-tooltip="Remove from Favorites"><i
                                                class="material-icons">favorite</i></a>
                                    @else
                                        <a onclick='addToFavorites("{{$m['movie_id']}}")' class="tooltipped"
                                           data-position="bottom" data-tooltip="Add to Favorites"><i
                                                class="material-icons">favorite_border</i></a>
                                    @endif
                                @endguest
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
        </div>
        <div class="section-footer">
            <div class="row">
                <div class="container center-align">
                    <a class="waves-effect red accent-4 waves-light btn" href="{{ route('movies') }}">View All</a>
                </div>
            </div>
        </div>
    </section>
@endsection
