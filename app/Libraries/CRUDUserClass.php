<?php
 
namespace App\Libraries;
use App\User;

class CRUDUserClass {

    private $user;

    function __construct(User $user) {
        $this->user = $user;
    }

    public function create($data){
        $newUser = $this->user->newInstance(); 

        $newUser->name = $data['name'];
        $newUser->lastname = $data['lastname'];
        $newUser->save();

        return $newUser;
    }

    public function read($id = null){

        if($id == null) {

            $result = $this->user->get();
            
        } else {

            $result = $this->user->find($id);

        }
        return $result;
    }


    public function update($id, $data){
        
        $user = $this->user->findOrFail($id);

        $user->name = $data['name']; 
        $user->lastname = $data['lastname']; 

        if($user->isDirty()){
            $user->save();
        }

        return $user; 

    }

    public function destroy($id){
        $user = $this->user->findOrFail($id);
            return  $user->delete($id);


    }

}