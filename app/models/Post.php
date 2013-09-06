<?php

class Post extends Eloquent{
    public function comments(){
        return $this->hasMany('Comment');
    }
    
    public static function boot(){
        parent::boot();
        static::deleted(function($post){
            $comments = $post->comments;
            $comments->each(function($comment){
                $comment->delete();
            });
        });
    }
}
?>
