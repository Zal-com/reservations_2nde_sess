@extends('layouts.main')

@section('title', 'Ajouter une localité')

@section('content')
    <h2>Ajouter une localité</h2>

    <form action="{{ route('locality.store') }}" method="post">
        @csrf
        <div>
            <label for="postcode">Postcode</label>
            <input type="text" id="postcode" name="postcode"
                   @if(old('postcode'))
                   value="{{ old('postcode') }}"
                   @endif
                   class="@error('postcode') is-invalid @enderror">

            @error('postcode')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="locality_fr">Locality_fr</label>
            <input type="text" id="locality_fr" name="locality_fr"
                   @if(old('locality_fr'))
                   value="{{ old('locality_fr') }}"
                   @endif
                   class="@error('locality_fr') is-invalid @enderror">

            @error('locality_fr')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="locality_nl">Locality_nl</label>
            <input type="text" id="locality_nl" name="locality_nl"
                   @if(old('locality_nl'))
                   value="{{ old('locality_nl') }}"
                   @endif
                   class="@error('locality_nl') is-invalid @enderror">

            @error('locality_nl')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button>Ajouter</button>
        <a href="{{ route('locality.index') }}">Annuler</a>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h2>Liste des erreurs de validation</h2>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <nav><a href="{{ route('locality.index') }}">Retour à l'index</a></nav>
@endsection
