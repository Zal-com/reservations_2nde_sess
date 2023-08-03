<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepresentationUser extends Model
{
    use CrudTrait;

    use HasFactory;

    protected $fillable = [
        'representation_id',
        'user_id',
        'seats',
        'unit_price',
        'total',
        'payment_id',
        'status'
    ];

    protected $table = 'representation_user';

    public $timestamps = false;

    /**
     * Get the user for that association.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the representation for that association.
     */
    public function representation(): BelongsTo
    {
        return $this->belongsTo(Representation::class);
    }
}
