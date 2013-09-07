<?php

class PostController extends BaseController {
    
    public function listPosts(){
        $posts = Post::all();
        return View::make('admin.post.list')->with('posts' , $posts);
    }
    
    public function showPost($id){
        if(!is_numeric(trim($id))){
            return Redirect::action('PostController@listPosts');
        }
        
        $post = Post::find($id);
        
        if(empty($post)){
            return Redirect::action('PostController@listPosts');
        }
        return View::make('admin.post.postdetails')->with('post', $post);
    }
    
    public function getAddPost(){
        return View::make('admin.post.add');
    }

    public function postAddPost(){
        $data = Input::all();
        $rules = array(
            'title' => 'required|min:3',
            'body' => 'required|min:10',
        );
        $validator = Validator::make($data, $rules);
        
        if($validator->passes()){
            $post = new Post();
            $post->author = Auth::user()->username;
            $post->title = htmlentities(trim($data['title']));
            $post->body = strip_tags($data['body'], '<strong><pre>');
            $post->save();
            return View::make('admin.post.add')->with('message' , 'Post successfuly added.');
        } else {
            return Redirect::to('admin/post/add')->withErrors($validator)->withInput();
        }
    }

    public function getEditPost($id){
        if(!is_numeric($id)){
            return Redirect::route('listAllPosts');
        }

        $post = Post::find($id);

        if(empty($post)){
            return Redirect::route('listAllPosts');
        }

        return View::make('admin.post.edit', array('post' => $post));
    }
    
    public function postEditPost($id){
        $data = Input::all();
        $rules = array(
            'title' => 'required|min:3',
            'body' => 'required|min:10',
        );
        $validator = Validator::make($data, $rules);
        
        if($validator->passes()){
            $post = Post::find($id);
            $post->title = htmlentities(trim($data['title']));
            $post->body = strip_tags($data['body'], '<strong><pre>');
            $post->save();
            return View::make('admin.post.postdetails')->with('post' , $post);
        } else {
            return Redirect::route('getEditPost', array('id' => $id))->withErrors($validator)->withInput();
        }
    }

    public function deletePost($id){
        $post = Post::find($id);
        if(isset($post)){
            $post->delete();
            return Redirect::action('PostController@listPosts')->with('message' , 'Post successfuly deleted.');
        } else {
            return Redirect::action('PostController@listPosts')->with('message' , 'Error while deleting post.');
        }
        
    }
    
    
}
?>
