<div class="flex w-[100%] flex-wrap" wire:model="render">
    @if(count($this->shows) == 0)
        <div class="w-[100%] text-center my-auto">
            <h1 class="text-gray-500 text-5xl">
                Pas de résultats.
            </h1>
        </div>
    @endif
    @foreach($this->shows as $show)
        <x-show-card :item="$show"/>
    @endforeach
</div>
