<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class CustomerController extends Controller
{
    /**
    *Create a new instance of the controller
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
    *Return the list of customers
     * @return \Response
     */
    public function index()
    {
        return view('customers.index');
    }

    /**
    *Return list of the customers
     *@return array
     */
    public function customers_list()
    {
        return Profile::all()->toArray();
    }
    /**
    *Create a new customer profile
     *@return \Response
     */
    public function create()
    {
        return view('customers.create');
    }
    /**
    *Store created customer to the database
     @params Request $request
     @return Response
     */
    public function store(Request $request)
    {
        //Validate the sent data
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'email|required',
            'phone' => 'string|required|unique:tbl_profiles',
            'address' => 'string|required',
            'national_id' => 'integer|required|unique:tbl_profiles'
        ]);

        //create the current customer profile on database
        Profile::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'national_id' => $request['national_id']
        ]);
        return redirect('/customers');
    }

    /**
    *Edit the current customer profile
     * @param Profile $profile
     * *@return \Response
     */
    public function edit(Profile $profile)
    {
        return view('customers.edit', ['profile' => $profile]);
    }

    /**
    *Public function store the updated customer
     *@params Request $request
     *@return \Response
     */
    public function store_update(Request $request)
    {
        //Validate the sent data
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'email|required',
            'phone' => 'string|required|unique:tbl_profiles',
            'address' => 'string|required',
            'national_id' => 'integer|required|unique:tbl_profiles'
        ]);

        $profile = Profile::find($request['id']);
        $profile->first_name = $request['first_name'];
        $profile->last_name = $request['last_name'];
        $profile->email = $request['email'];
        $profile->phone = $request['phone'];
        $profile->address = $request['address'];
        $profile->national_id = $request['national_id'];
        $profile->save();
        return redirect('customers');
    }

    /**
    *Delete a certain customer
     *@param Profile $profile
     *@return \Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect('/customers');
    }
}
