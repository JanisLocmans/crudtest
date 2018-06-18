<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\User;
use App\Post;
use App\Http\Controllers\Crud;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = array();
        if($request->input('user')){//Checks if theres any input 

            $data = Post::where('user_id', $request->input('user'))->get();  
            return $data;
        } else {      //Dumps all posts and info about them
            $data = Post::get();
            foreach( $data as $item ) {
                $result[] = ' | post id | ' . $item->id . ' | user id | ' . $item->user->id . ' | user name | ' . $item->user->name . ' | post title | ' . $item->title . ' | post content | ' . $item->content . '<br>' ;
            }
            return $result;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->get('posts');

        if(!empty($data)){
            foreach($data as $item){
                $user_exist = User::where('id', $item['user_id'])->first();            
                if($user_exist != null){ //Check if user is found!
                    $post = new Post();
                    $post->user_id = $item['user_id'];
                    $post->title = $item['title'];
                    $post->content = $item['content'];
                    $post->save();
                } else  { //collect posts where user does not exist!
                    $error[] = 'This user does not exist: ' . $item['user_id'];
                }               
            }
            if(isset($error)){
                return $error;
            } else {
                return 'All data added !';
            }          
        } else { //JSON is not formatted correctly
            $message = "Invalid Json format !";
            return $message ;
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
