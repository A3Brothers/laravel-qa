<?php

namespace App\Models;

use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    use Vote;

    protected $fillable = ['title', 'body'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function favorites(){
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps(); //, 'user_id', 'question_id');
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function setTitleAttribute($value){
        
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // public function setBodyAttribute($value){
    //     $this->attributes['body'] = Purifier::clean($value);
    // }

    public function getUrlAttribute(){
        return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        if($this->answers_count > 0){
            if($this->best_answer_id){
                return "approvedanswered";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    // public function getBodyHtmlAttribute(){
    //     return \Parsedown::instance()->text($this->body);
    // }

    public function acceptBestAnswer(Answer $answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function getBodyHtmlAttribute()
    {
        return Purifier::clean($this->body);
    }

}
