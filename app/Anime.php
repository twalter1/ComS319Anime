<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'animes';

    /**
     * Get all of the users that are followers of this anime
     */
    public function user_followers()
    {

        return $this->belongsToMany(User::class, 'following_animes', 'anime_id', 'user_id');

    }

}
