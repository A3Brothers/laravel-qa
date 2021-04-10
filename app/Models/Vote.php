<?php

namespace App\Models;

trait Vote {
    public function voteUsers(){
        return $this->morphToMany(User::class, 'votable');
    }

    public function downVotes(){
        return $this->voteUsers()->wherePivot('vote', -1);
    }
    public function upVotes(){
        return $this->voteUsers()->wherePivot('vote', 1);
    }
}