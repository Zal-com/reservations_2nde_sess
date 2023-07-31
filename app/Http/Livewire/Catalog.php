<?php

namespace App\Http\Livewire;

use App\Models\Show;
use Livewire\Component;

class Catalog extends Component
{
    /* Wire models */
    public $shows;

    public function render()
    {
        return view('livewire.catalog',[
            'shows' => $this->shows,
        ]);
    }
}
