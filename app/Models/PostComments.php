<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|PostComments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComments query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComments whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComments wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComments whereUserId($value)
 * @mixin \Eloquent
 */
class PostComments extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'comment',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(PostComments::class, 'parent_id');
    }

    public function parentComment(): BelongsTo
    {
        return $this->belongsTo(PostComments::class, 'parent_id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
