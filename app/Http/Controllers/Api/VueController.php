<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VueResource;
use App\Http\Resources\VueCollection;
use App\Vue;

class VueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VueCollection(Vue::orderBy('id', 'DESC')->paginate(5));
    }


    public function search($field, $query)
    {
        return new VueCollection(Vue::where($field,'LIKE',"%$query%")->latest()->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:vues',
            'phone'=>'required|numeric',
            'address'=>'required',
            'total'=>'required|numeric'
        ]);

        $data = new Vue;
        $data -> name = $request -> name;
        $data -> email = $request -> email;
        $data -> phone = $request -> phone;
        $data -> address = $request -> address;
        $data -> total = $request -> total;
        $data-> save();
        return new VueResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new VueResource(Vue::findOrFail($id));
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
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:vues,email,'.$id,
            'phone'=>'required|numeric',
            'address'=>'required',
            'total'=>'required|numeric'
        ]);

        $data = Vue::find($id);
        $data -> name = $request -> name;
        $data -> email = $request -> email;
        $data -> phone = $request -> phone;
        $data -> address = $request -> address;
        $data -> total = $request -> total;
        $data-> update();
        return new VueResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Vue::findOrFail($id);
        $data->delete();
        return new VueResource($data);
    }
}
