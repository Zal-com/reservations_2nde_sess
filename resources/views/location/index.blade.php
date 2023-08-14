@extends('layouts.main')

@section('title', 'Salles')

@section('content')

    <div class="container px-5 py-4 my-auto">
        <div class="flex flex-wrap">
            @foreach($locations as $item)
                <div class="p-4 md:w-1/3 card h-100%">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow my-2 mx-auto">
                        <div class="p-5 m-h-300">
                            <a href="{{route('location.show', ['slug' => $item['slug']])}}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 line-clamp-1">
                                    {{$item->designation}}
                                </h5>
                            </a>
                            <table class="w-[100%] card-class" >
                                <thead class="card-th">
                                @if($item->website)
                                    <tr>
                                        <td class="d-flex align-content-start">
                                            <span class="items-baseline">
                                                <i class="fa fa-globe mr-2"></i>
                                                <a href="{{$item->website}}" target="_blankx">
                                                    @php

                                                    $website = explode('/', $item->website);

                                                    if(sizeof($website) > 2){
                                                        echo $website[2];
                                                    }
                                                    else echo $website[0];

                                                    @endphp
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                                @if($item->phone)
                                    <tr>
                                        <td class="d-flex align-content-start">
                                            <span class="items-baseline">
                                                <i class="fa fa-phone mr-2"></i>
                                                {{$item->phone}}
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                                </thead>
                            </table>
                            <div class="flex justify-end">
                                <a
                                    href="{{route('location.show', ['slug' => $item['slug']])}}"
                                    class="btn btn-secondary inline-flex items-center px-3 py-2 mt-4 text-sm font-medium rounded-lg">
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
                </div>

            @endforeach
        </div>

@endsection

