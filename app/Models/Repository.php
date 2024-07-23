<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 *
 *
 * @property int                             $id
 * @property int                             $user_id
 * @property string                          $url
 * @property string                          $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null      $user
 * @method static \Database\Factories\RepositoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Repository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Repository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Repository query()
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereUserId($value)
 * @mixin \Eloquent
 */
class Repository extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'url',
        'description'
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
