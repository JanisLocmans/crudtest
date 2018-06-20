<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreUpdatePost;
use App\User;
use App\Post;
use App\Libraries\CRUDPostClass;

class PostController extends Controller
{
    protected $crudPostClass;

    /**
     * Controller constructor
    */
    function __construct(CRUDPostClass $crudPostClass){
        $this->crudPostClass = $crudPostClass;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->crudPostClass->read(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePost $request) // TODO: Validate
    {
        return response()->json($this->crudPostClass->create($request->all()));     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->crudPostClass->read($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePost $request, $id)
    {
        return response()->json($this->crudPostClass->update($id, $request->all())); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json($this->crudPostClass->destroy($id)); 
    }
}
