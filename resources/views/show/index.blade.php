@extends('layouts.main')

@section('title', 'Liste des spectacles')

@section('content')
    <div class="container px-5 py-4 my-auto">
        <div class="flex flex-wrap">
            @foreach($shows as $item)
                <div class="p-4 md:w-1/3 card h-100%">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow my-2 mx-auto">
                        <a href="{{route('show.show', ['slug' => $item->slug])}}">
                            <img class="rounded-t-lg" src="https://via.placeholder.com/400x300" alt="" />
                        </a>
                        <div class="p-5 m-h-300">
                            <a href="{{route('show.show', ['slug' => $item->slug])}}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 line-clamp-1">
                                    {{$item->title}}
                                </h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 text-ellipsis overflow-hidden line-clamp-2">
                                {{$item->description}}
                            </p>
                            <span class="text-gray-400 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm py-1 mx-2">
                                {{ $item->price }} €
                            </span>
                            <span class="text-gray-400 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm py-1 mx-2">
                               {{ $item->representationsString() }}
                            </span>
                            <span class="text-gray-400 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm py-1 mx-2">
                                {{ $item->bookableString() }}
                            </span>
                            <a
                                href="{{route('show.show', ['slug' => $item->slug])}}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4
                                focus:outline-none focus:ring-blue-300">
                                {{__('Read more')}}
                                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0
                                    110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

