@extends('layouts.main')

@section('title', 'Fiche d\'un lieu de spectacle')

@section('content')
    <div class="pl-40">
        <h1>{{ $location->designation }}</h1>
        <div>
            <p>{{ $location->address }}</p>
            <p>{{ $location->locality->postal_code }}
                {{ $location->locality->locality }}
            </p>

            @if($location->website)
                <p><a href="{{ $location->website }}" target="_blank">{{ $location->website }}</a></p>
            @else
                <p>Pas de site web</p>
            @endif

            @if($location->phone)
                <p><a href="tel:{{ $location->phone }}">{{ $location->phone }}</a></p>
            @else
                <p>Pas de téléphone</p>
            @endif
        </div>

        <h2>Liste des spectacles</h2>

        @foreach($location->shows as $show)
            <x-show-card :item="$show"/>
        @endforeach
    </div>

    <nav><a href="{{ route('location.index') }}">Retour à l'index</a></nav>
@endsection
