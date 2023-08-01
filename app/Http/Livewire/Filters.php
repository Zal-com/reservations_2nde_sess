<?php

namespace App\Http\Livewire;

use App\Models\Show;
use Carbon\Carbon;
use Livewire\Component;

class Filters extends Component
{

    public $filter = '';

    public function render()
    {
        return view('livewire.filters');
    }

    public function filter(){
        switch ($this->filter){
            case 'asc' : $shows = Show::orderBy('price', 'asc')->where('bookable', 1)->get();
                break;
            case 'desc' : $shows = Show::orderBy('price', 'desc')->where('bookable', 1)->get();
                break;
            case 'today' : $shows = $this->getRepresentationsOnDate(Carbon::today()->format('Y-m-d'));
                break;
            case 'tomorrow' : $shows = $this->getRepresentationsOnDate(Carbon::today()->addDay()->format('Y-m-d'));
                break;
            case (preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", $this->filter) ? true : false) : $shows = $this->getRepresentationsOnDate(Carbon::make($this->filter)->format('Y-m-d'));
                break;
        }

        foreach ($shows as $show) {
            $show['representationString'] = $show->representationsString();
        }

        $this->emit('updateResults', $shows);
    }

    private function getRepresentationsOnDate(string $date)
    {
        $showsOnDate = [];
        $shows = Show::where('bookable', 1)->get();

        foreach ($shows as $show){
            foreach ($show->representations as $representation) {
                if(Carbon::make($representation->when)->format('Y-m-d') == $date){
                    array_push($showsOnDate, $representation->show);
                }
            }
        }

        return $showsOnDate;
    }
}
