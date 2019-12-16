<?php

declare(strict_types=1);

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class AssetReview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_positive',
        'comment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'asset_id',
        'author_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_positive' => 'boolean',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * (We use `$with` because we can't use `load()` with nested submodels for some reason...)
     * `asset` is used in authorization gates, so it should always be
     * eager loaded to avoid N+1 queries.
     *
     * @var array
     */
    protected $with = [
        'asset',
        'author',
        'reply',
    ];

    /**
     * Get the asset which is the subject of the review.
     */
    public function asset()
    {
        return $this->belongsTo('App\Asset', 'asset_id');
    }

    /**
     * Get the user that posted the review.
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * Get the comment reply by the asset author.
     */
    public function reply()
    {
        return $this->hasOne('App\AssetReviewReply');
    }

    /**
     * Set the comment, render the Markdown and save the rendered comment.
     * This way, the source Markdown only has to be rendered once
     * (instead of being rendered every time a page is displayed).
     */
    public function setCommentAttribute(string $comment = null): void
    {
        if ($comment) {
            $this->attributes['comment'] = $comment;
            $this->attributes['html_comment'] = Markdown::convertToHtml($comment);
        }
    }
}
