<?php

class CommentController extends BaseController {

	public function addComment($post_id){
        $data = Input::all();
        $post = Post::find($post_id);
        $comment = new Comment();
        $comment->author = htmlentities(trim($data['author']));
        $comment->body = strip_tags($data['body'], '<strong><pre>');
        $post->comments()->save($comment);
        return Redirect::action('PostController@showPost', array('id'=>$post->id));
    }

    public function getEditComment($comment_id){
        if(!is_numeric($comment_id)){
        	return Redirect::route('listAllPosts');
        }

        $comment = Comment::find($comment_id);
        if(empty($comment)){
        	return Redirect::route('listAllPosts');
        }

        return View::make('admin.post.editcomment')->with('comment', $comment);
    }

    public function postEditComment($comment_id){
    	$data = Input::all();
        $rules = array(
            'body' => 'required|min:10',
        );
        $validator = Validator::make($data, $rules);
        
        if($validator->passes()){
            $comment = Comment::find($comment_id);
            $comment->body = strip_tags($data['body'], '<strong><pre>');
            $comment->save();
            return View::make('admin.post.postdetails')->with('post' , $comment->post);
        } else {
            return Redirect::route('getEditComment', array('comment_id' => $comment_id))->withErrors($validator)->withInput();
        }
    }

    public function deleteComment($comment_id){
        $comment = Comment::find($comment_id);
        $post_id = $comment->post_id;
        $comment->delete();
        return Redirect::action('PostController@showPost', array('id'=> $post_id));
    }

}
?>