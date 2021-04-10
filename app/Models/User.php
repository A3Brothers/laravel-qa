<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function favorites(){
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps(); //, 'user_id', 'question_id');
    }

    public function getUrlAttribute(){
        // return route("questions.show", $this->id);
        return '#';
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;

        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function voteQuestions(){
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function voteAnswers(){
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function voteQuestion(Question $question, $vote){

        $voteQuestions = $this->voteQuestions();
        
        $this->_vote($voteQuestions, $question, $vote);

        $question->load('voteUsers');

        $downVotes = (int) $question->downVotes()->sum('vote');
        $upVotes = (int) $question->upVotes()->sum('vote');

        $question->votes = $upVotes + $downVotes;
        $question->save();
    }

    public function voteAnswer(Answer $answer, $vote){

        $voteAnswers = $this->voteAnswers();

        $this->_vote($voteAnswers, $answer, $vote);

        $answer->load('voteUsers');

        $downVotes = (int) $answer->downVotes()->sum('vote');
        $upVotes = (int) $answer->upVotes()->sum('vote');

        $answer->votes_count = $upVotes + $downVotes;
        $answer->save();
    }

    public function _vote($relationship, $model, $vote){
        if($relationship->where('votable_id', $model->id)->exists()){
            $relationship->updateExistingPivot($model, ['vote'=>$vote]);
        }else{
            $relationship->attach($model, ['vote'=>$vote]);
        }
    }
}
