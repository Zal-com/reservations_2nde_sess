<div>
    <label for="asc">
        <li class="bg-white border border-gray-200 rounded-lg shadow my-2 mx-2 p-2">
            <input type="radio" wire:model="filter" wire:click.debounce="filter" name="filter" value="asc">
            Prix croissant
        </li>
    </label>

    <label for="desc">
        <li class="bg-white border border-gray-200 rounded-lg shadow my-2 mx-2 p-2">
            <input type="radio" wire:model="filter" wire:click.debounce="filter"  name="filter" value="desc">
            Prix décroissant
        </li>
    </label>

    <label for="today">
        <li class="bg-white border border-gray-200 rounded-lg shadow my-2 mx-2 p-2">
            <input type="radio" wire:model="filter" wire:click="filter" name="filter" value="today">
            Aujourd'hui
        </li>
    </label>
    <label for="tomorrow">
        <li class="bg-white border border-gray-200 rounded-lg shadow my-2 mx-2 p-2">
            <input type="radio" wire:model="filter" wire:click="filter"  name="filter" value="tomorrow">
            Demain
        </li>
    </label>
    <hr style="border: 1.5px solid grey; opacity: 20%; margin-left: 5%; margin-right: 5%">
    <li>
        <input type="date" wire:model="filter" wire:change="filter" class="bg-white border border-gray-200 rounded-lg shadow my-2 mx-2 p-2 w-[92%]">
    </li>
</div>
