<?php
 
namespace App\Libraries;
use App\User;
 
class CRUDUserClass {

    public function create($JSONArray){

        $data = $JSONArray;

        foreach($data as $item){

            $newUser = new User();
            $newUser->name = $item['name'];
            $newUser->lastname = $item['lastname'];
            $newUser->save();
        }
        return $newUser->toJson();
    }

    public function read($id = null){

        if($id == null) {

            $result = User::get();
            
        } else {

            $result = User::find($id);

        }
        return $result;
    }


    public function update($id, $JSONstring){

            $data = $JSONstring;
            $user = User::find($id);

            if($user){//exit - 1 : User found Updates user 
                $changed = false;

                if($user->name != $data[0]['name']) {
                    $user->name = $data[0]['name'];
                    $changed = true;
                }

                if($user->lastname != $data[0]['lastname']) {
                    $user->lastname = $data[0]['lastname'];
                    $changed = true;
                }

                if($changed == true) {
                    $user->save();
                }                

                return $user; 

            } else { //exit - 2 : User not Found           
                return 'User not Found';
            }
        
    }

    public function destroy($id){

        $user = User::find($id);            
            if($user) { //exit - 1 : User Found  
                User::destroy($id); 
                return 'User deleted';
            }  else { //exit - 2 : User not Found  
                return 'User not Found';              
            }

    }
}