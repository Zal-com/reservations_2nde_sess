<div class="flex flex-wrap" wire:model="render">
    @foreach($this->shows as $show)
            <x-show-card :item="$show"/>
    @endforeach
</div>
