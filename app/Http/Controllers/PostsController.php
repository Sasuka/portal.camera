<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    private $err = 'errors';
    private $suc = 'success';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function __construct()
    {
        $this->middleware('permission:post.index|post.show')->only(array('index','show'));
        $this->middleware('permission:post.create|post.store')->only(array('create','store'));
        $this->middleware('permission:post.edit|post.update')->only(array('edit','update'));
        $this->middleware('permission:post.destroy')->only(array('destroy'));
    }

    public function index()
    {
        //
        return response()->json(['status'=>$this->suc,'mess'=>'This is index'],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->json(['status'=>$this->suc,'mess'=>'This is create'],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
        return response()->json(['status'=>$this->suc,'mess'=>'This is store'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return response()->json(['status'=>$this->suc,'mess'=>'This is show'],200);
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
        return response()->json(['status'=>$this->suc,'mess'=>'This is edit'],200);
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
        return response()->json(['status'=>$this->suc,'mess'=>'This is update'],200);
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
        return response()->json(['status'=>$this->suc,'mess'=>'This is delete'.$id],200);
    }
}
