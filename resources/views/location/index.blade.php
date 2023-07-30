@extends('layouts.main')

@section('title', 'Salles')

@section('content')

    <div class="container px-5 py-4 my-auto">
        <div class="flex flex-wrap">
            @foreach($locations as $item)
                <div class="p-4 md:w-1/3 card">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow my-2 mx-auto">
                        <a href="#">
                            <img class="rounded-t-lg" src="https://via.placeholder.com/400x300" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="{{ route('location.show', ['slug' => $item->slug]) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $item->designation }}</h5>
                            </a>
                            @if( $item->website )
                                <div>
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                    <span>{{ $item->website }}</span>
                                </div>
                            @endif
                            @if( $item->phone )
                                <div>
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>{{ $item->phone }}</span>
                                </div>
                            @endif
                            <a class="text-indigo-500 md:mb-2 lg:mb-0">
                                {{__('Voir')}}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

