<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;

use App\Http\Requests\StoreUpdatePost;
use App\Libraries\CRUDPostClass;

class PostController extends Controller
{
    protected $crudPostClass;

    function __construct(CRUDPostClass $crudPostClass){
        $this->crudPostClass = $crudPostClass;
    }

    public function index()
    {
        return $this->crudPostClass->read(); 
    }

    public function store(StoreUpdatePost $request)
    {
        return response()->json($this->crudPostClass->create($request->all()));
    }

    public function show($id)
    {
        return $this->crudPostClass->read($id);
    }

    public function update(StoreUpdatePost $request, $id)
    {
        return response()->json($this->crudPostClass->update($id, $request->all())); 
    }

    public function destroy($id)
    {
        return response()->json($this->crudPostClass->destroy($id)); 
    }
}
