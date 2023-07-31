<?php

namespace App\Http\Livewire;

use App\Models\Show;
use Livewire\Component;

class SearchBar extends Component
{

    public $search = "";

    public function render()
    {
        return view('livewire.search-bar');
    }

    public function search(){
        if(strlen($this->search) >= 1){
            $shows = Show::where('title', 'LIKE', '%' . $this->search . '%')->where('bookable', 1)->get();
        }
        else{
            $shows = Show::where('bookable', 1)->get();
        }

        foreach ($shows as $show) {
            $show['representationString'] = $show->representationsString();
        }

        $this->emit('updateResults', $shows);
    }
}
