<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function index()
    {
    	return view('customer');
    }

    public function save(Request $request)
    {
    	// dd($request -> all());
    	$this->validate($request, [
    		'name' => 'required',
    		'phone' => 'required',
    		'address' => 'required'
    	]);

    	$data = new Customer();
    	$data->name = $request->name;
    	$data->phone = $request->phone;
    	$data->address = $request->address;
    	$data->save();

    }

    public function show()
    {
    	$data = Customer::all();
    	return $data;
    }

    public function edit($id)
    {
    	$data = Customer::find($id);
    	return view('customerEdit', compact('data'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $data = Customer::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->update();

        
        return "Update Done";
         // Customer::find($id)->update($request->all());
    }


    public function delete($id)
    {
        $data = Customer::find($id);
        $data->delete();
        return 'deleted';
    }


}
