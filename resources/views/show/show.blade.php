@extends('layouts.main')

@section('title', 'Fiche d\'un spectacle')

@section('content')
    <article>
        <h1>{{ $show->title }}</h1>

        @if($show->poster_url)
            <p><img src="{{ asset('images/'.$show->poster_url) }}" alt="{{ $show->title }}" width="200"></p>
        @else
            <canvas width="200" height="100" style="border:1px solid #000000;"></canvas>
        @endif

        @if($show->location)
            <p class="text-st">Lieu de création: {{ $show->location->designation }}</p>
        @endif

        <p class="text-st">Prix: {{ $show->price }} €</p>

        @if($show->bookable)
            <p class="text-it">Réservable</p>
        @else
            <p>Non réservable</p>
        @endif

        <h2>Liste des représentations</h2>
        @if($show->representations->count() >= 1)
            <ul>
                @foreach ($show->representations as $representation)
                    <li>
                        {{ $representation->when }}
                        @if($representation->location)
                            ({{ $representation->location->designation }})
                        @elseif($representation->show->location)
                            ({{ $representation->show->location->designation }})
                        @else
                            (lieu à déterminer)
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucune représentation</p>
        @endif
{{--
        <h2>Liste des artistes</h2>
        <p>
            <span class="text-st">Auteur:</span>
            @foreach ($collaborateurs['auteur'] as $auteur)
                {{ $auteur->firstname }} {{ $auteur->lastname }}
                @if($loop->iteration === $loop->count-1)
                    et
                @elseif(!$loop->last)
                    ,
                @endif
            @endforeach
        </p>
        <p>
            <span class="text-st">Metteur en scène:</span>
            @foreach ($collaborateurs['scénographe'] as $scenographe)
                {{ $scenographe->firstname }} {{ $scenographe->lastname }}
                @if($loop->iteration === $loop->count-1)
                    et
                @elseif(!$loop->last)
                    ,
                @endif
            @endforeach
        </p>
        <p>
            <span class="text-st">Distribution:</span>
            @foreach ($collaborateurs['comédien'] as $comedien)
                {{ $comedien->firstname }} {{ $comedien->lastname }}
                @if($loop->iteration === $loop->count-1)
                    et
                @elseif(!$loop->last)
                    ,
                @endif
            @endforeach
        </p>
        --}}
    </article>

    <nav>
        <a href="{{ route('show.list') }}">Retour à l'index</a>
    </nav>
@endsection
