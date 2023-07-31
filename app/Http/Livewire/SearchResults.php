<?php

namespace App\Http\Livewire;

use App\Models\Show;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SearchResults extends Component
{
    public $shows;
    protected $listeners = ['updateResults' => 'updateResults'];


    public function render()
    {

        return view('livewire.search-results', [$this->shows]);
    }

    public function updateResults ($results){
        $this->shows = $results;
    }

    public function mount()
    {
        $shows = Show::where('bookable', 1)->get();

        foreach ($shows as $show) {
            $show['representationString'] = $show->representationsString();
        }

       return $this->shows = $shows;
    }
}
