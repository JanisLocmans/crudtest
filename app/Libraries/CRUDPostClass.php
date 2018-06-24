<?php
 
namespace App\Libraries;
use App\Post;
use App\User;

class CRUDPostClass {

    private $post;
    private $user;

    function __construct(Post $post, User $user) {
        $this->post = $post;
        $this->user = $user;
    }

    public function create($data) {

        //return $data;

        if($this->user->find($data['user_id'])) { // Exit 1

            $newPost = $this->post->newInstance();

                $newPost->user_id = $data['user_id'];
                $newPost->title = $data['title'];
                $newPost->content = $data['content'];

            $newPost->save();

            return $newPost;

        } else { // Exit 2

            return 'User not Found';

        }
    }

    public function read($id = null) {

        if($id == null) {

            $result = $this->post->get();
            
        } else {

            $result = $this->post->find($id);

        }
        return $result;

    }

    public function update($id, $data){

        if($this->user->find($data['user_id'])) { // Exit 1
            
            $post = $this->post->findOrFail($id);
            $post->user_id = $data['user_id']; 
            $post->title = $data['title']; 
            $post->content = $data['content']; 

            if($post->isDirty()){
                $post->save();
            }

                return $post;
            } else { //Exit 2
            return 'User not Found';
        } 
    }

    public function destroy($id){
        $post = $this->post->findOrFail($id);
        
        return  $post->delete($id);
    }

}