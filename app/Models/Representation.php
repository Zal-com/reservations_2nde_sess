<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Representation extends Model
{
    use CrudTrait;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'show_id',
        'when',
        'location_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'representations';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the show of the representation
     */
    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }

    /**
     * Get the actual location of the representation
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the representationUsers for the representation.
     */
    public function representationUsers(): HasMany
    {
        return $this->hasMany(RepresentationUser::class);
    }

    /**
     * The users that belong to the representation.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
