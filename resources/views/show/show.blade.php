@extends('layouts.main')

@section('title', $show->title)

@section('content')
    <div class="container">
        <h1 class="mb-4 pl-40">{{ $show->title }}</h1>

        <div class="inline-flex pl-40">
            <div class="mr-8">
                <div>
                    @if($show->poster_url)
                        <p><img src="{{ Storage::url($show->poster_url) }}" alt="{{ $show->title }}" width="200"></p>
                    @else
                        <canvas width="200" height="100" style="border:1px solid #000000;"></canvas>
                    @endif
                </div>
            </div>
            <div class="w-[100%]">
                <div class="w-[100%]">
                    @if($show->location)
                        <p class="text-st"><b>Lieu de création :</b> {{ $show->location->designation }}</p>
                    @endif
                </div>
                <div>
                </div>
                <div class="my-4 w-[80%]">
                    <h2>Synopsis</h2>
                    <p class="text-justify">{{$show->description}}</p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(count($representations) == 0)
                    <div class="w-[100%] text-center my-10">
                        <h1 class="text-gray-500 text-3xl">
                            Pas de représentations.
                        </h1>
                    </div>
                @else
                    <h2>Showtime</h2>
                    <table class="table-auto striped w-4/5">
                        @if(count($representations) == 1)
                            @php
                                if(! isset($currentDate)){
                                    $currentDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $representations[0]->when);
                                }
                            @endphp
                            <thead class="text-left">
                            <th class="text-white px-2" colspan="3">{{$currentDate->format('l d F')}}</th>
                            </thead>
                        @endif

                        @foreach($representations as $representation)
                            @if( isset($currentDate) and $currentDate == \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $representation->when))
                                <tr class="align-middle">
                                    <td class="align-middle">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 inline-block">
                                            <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                                        </svg>
                                        {{$representation->location->designation}}
                                    </td>
                                    <td class="align-middle">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 inline-block">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" />
                                        </svg>
                                        {{$currentDate->format('H:i')}}
                                    </td>
                                    <td class="align-middle float-right pr-5">
                                        <form method="post" action="{{route('stripe.checkout')}}">
                                            @csrf
                                            <input type="hidden" name="representation_id" value="{{$representation->id}}">
                                            <select name="quantity">
                                                <option value="1">1</option>
                                                <option value="2" selected>2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="1">10</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary hover:text-white font-medium rounded-lg px-5 py-2.5 text-center mr-3 md:mr-0">Réserver</button>
                                        </form>

                                    </td>
                                </tr>
                            @else
                                @php
                                    $currentDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $representation->when);
                                @endphp
                                <thead class="text-left">
                                <th class="text-white px-2" colspan="3">{{$currentDate->format('l d F')}}</th>
                                </thead>
                                <tbody>
                                <tr class="align-middle">
                                    <td class="align-middle">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 inline-block">
                                            <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                                        </svg>
                                        {{$representation->location->designation}}
                                    </td>
                                    <td class="align-middle">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 inline-block">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" />
                                        </svg>
                                        {{$currentDate->format('H:i')}}

                                    </td>
                                    <td class="align-middle float-right pr-5">
                                        <form method="post" action="{{route('stripe.checkout')}}">
                                            @csrf
                                            <input type="hidden" name="representation_id" value="{{$representation->id}}">
                                            <select name="quantity">
                                                <option value="1">1</option>
                                                <option value="2" selected>2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="1">10</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary hover:text-white font-medium rounded-lg px-5 py-2.5 text-center mr-3 md:mr-0">Réserver</button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection
