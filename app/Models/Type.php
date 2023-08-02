<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use CrudTrait;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'types';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The artists that are defined by the type.
     */
    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }

    /**
     * The types that belong to the artist.
     */
    public function artistTypes(): HasMany
    {
        return $this->hasMany(ArtistType::class);
    }
}
