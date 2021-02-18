<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Filmes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg col-3">
                <div class="row">
                    @forelse($moviesList as $movie)
                        <div class="col-3">
                            <div class="movie-poster">
                                <img src="{{$movie->poster_path}}" class="img-responsive">
                            </div>
                        {{$movie->title}}<br>
                        </div>
                    @empty
                        Lista Vazia
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
