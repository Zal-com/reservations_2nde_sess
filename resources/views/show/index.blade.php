@extends('layouts.main')

@section('title', 'Liste des spectacles')

@section('content')
    <div class="container px-5 py-4 my-auto flex">
        <aside class="max-w-sm h-fit bg-white border border-gray-200 rounded-lg shadow my-2 mt-6">
            <ul>
                <li>
                    @livewire('search-bar')
                </li>
                <hr style="border: 1.5px solid grey; opacity: 20%; margin-left: 5%; margin-right: 5%">
                @livewire('filters')
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

