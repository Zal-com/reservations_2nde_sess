<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ArtistType extends Model
{
    use CrudTrait;

    use HasFactory;

    protected $fillable = [
        'artist_id',
        'type_id',
    ];

    protected $table = 'artist_type';

    public $timestamps = false;

    /**
     * Get the shows of the performance (artist in a type of collaboration for a show)
     */
    public function shows(): BelongsToMany
    {
        return $this->belongsToMany(Show::class);
    }

    /**
     * Get the artist for that association.
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Get the type for that association.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }


}
