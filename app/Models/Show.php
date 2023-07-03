<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Show extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'poster_url',
        'location_id',
        'bookable',
        'price',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shows';

    //timestamps on true

    /**
     * Get the representations of the show
     */
    public function representations(): HasMany
    {
        return $this->hasMany(Representation::class);
    }

    /**
     * Get the location of the show
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the performances (artists in a type of collaboration) for the show
     */
    public function artistTypes(): BelongsToMany
    {
        return $this->belongsToMany(ArtistType::class);
    }

    public function representationsString(){

        $count = count($this->representations);
        if($count == 0){
            return "Pas de représentations";
        }

        if($count == 1) return "1 représentation";

        return "$count représentations";
    }

    public function bookableString(){
       return $this->bookable ? 'Réservable' : 'Pas réservable';
    }
}
