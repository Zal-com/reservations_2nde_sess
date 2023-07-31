<div class="flex flex-wrap">
    @foreach($shows as $item)
        <x-show-card :item="$item"/>
    @endforeach
</div>

