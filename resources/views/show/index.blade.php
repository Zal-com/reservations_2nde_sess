@extends('layouts.main')

@section('title', 'Liste des spectacles')

@section('content')
    <div class="container px-5 py-4 my-auto">
        <div class="flex flex-wrap">
            @foreach($shows as $item)
                <x-show-card :item="$item"/>
            @endforeach
        </div>
    </div>
@endsection

