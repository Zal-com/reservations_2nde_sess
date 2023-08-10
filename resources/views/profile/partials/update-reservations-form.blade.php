<section>
    <a href="#reservations"></a>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Reservations') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Consultez vos réservations futures et annulez-les si nécessaire") }}
        </p>
    </header>
    <div id="reservations">
        @foreach($reservations as $reservation)
            <div class="grid grid-cols-4 grid-rows-2 gap-0 auto-cols-auto">
                <div class="col-span-2 p-2 my-auto">
                    <h2 class="overflow-ellipsis">{{$reservation->representation->show->title}}</h2>
                </div>
                <div class="col-span-2 col-start-1 row-start-2 p-2">
                    <p class="line-clamp-2">{{$reservation->representation->show->description}}</p>
                </div>
                <div class="row-span-2 col-start-3 row-start-1 p-2 my-auto ml-4">
                    <div>
                        <i class="fa-solid fa-clock"></i>
                        {{Carbon\Carbon::make($reservation->representation->when)->format('H:i')}}
                    </div>
                    <div>
                        <i class="fa-solid fa-calendar"></i>
                        {{Carbon\Carbon::make($reservation->representation->when)->format('d/m/Y')}}
                    </div>
                </div>
                <div class="col-start-4 row-start-1 p-2 my-auto">
                    <form method="post" action="{{route('stripe.cancel', ['id' => $reservation->id])}}">
                        @csrf
                        <button type="submit" class="btn bg-primary border-[10px]">Annuler</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</section>
