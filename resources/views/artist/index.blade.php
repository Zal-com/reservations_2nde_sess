@extends('layouts.main')

@section('title', 'Liste des artistes')

@section('content')
        <h1 class="text-6xl font-normal leading-normal mt-0 mb-2 text-indigo-500 text-center">
            Liste des artistes
        </h1>
            <div class="container px-5 py-4 my-auto">
                <div class="flex flex-wrap">
                    @foreach($artists as $item)
                        <div class="p-4 md:w-1/2 ">
                            <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 mx-auto">
                                <img class="object-cover w-full rounded-t-lg h-full md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{\Faker\Provider\Image::imageUrl()}}" alt="">
                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $item->firstname }} {{ $item->lastname }}</h5>
                                    <p class="mb-3 font-normal text-gray-700">Role ...</p>
                                    <p class="mb-3 font-normal text-gray-700">Role ...</p>
                                    <p class="mb-3 font-normal text-gray-700">Role ...</p>
                                </div>
                            </a>
                        </div>

                    @endforeach
                </div>
            </div>
@endsection
