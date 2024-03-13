<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property int $post_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|PostTags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTags query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTags whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTags whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTags whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTags wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTags whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostTags extends Model
{
    protected $fillable = [
        'post_id',
        'name',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
