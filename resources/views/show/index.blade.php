@extends('layouts.main')

@section('title', 'Liste des spectacles')

@section('content')
    <div class="container px-5 py-4 my-auto flex">
        <aside class="max-w-sm h-fit bg-white border border-gray-200 rounded-lg shadow my-2 mx-auto">
            <ul>
                @livewire('search-bar')
                <li class="bg-white border border-gray-200 rounded-lg shadow my-2 mx-2 p-2">
                    <input type="radio" name="filter" id="asc">
                    <label for="asc">Prix croissant</label>
                </li>
                <li class="bg-white border border-gray-200 rounded-lg shadow my-2 mx-2 p-2">
                    <input type="radio"name="filter" id="desc">
                    <label for="desc">Prix décroissant</label>
                </li>
                <li class="bg-white border border-gray-200 rounded-lg shadow my-2 mx-2 p-2">
                    <input type="radio" name="filter" id="today">
                    <label for="today">Aujourd'hui</label>
                </li>
                <li class="bg-white border border-gray-200 rounded-lg shadow my-2 mx-2 p-2">
                    <input type="radio" name="filter" id="tomorrow">
                    <label for="tomorrow">Demain</label>
                </li>
            </ul>
        </aside>
        @livewire('search-results')
        {{--<div class="flex flex-wrap">
            @foreach($shows as $item)
                <x-show-card :item="$item"/>
            @endforeach
        </div>
        --}}
    </div>
@endsection

