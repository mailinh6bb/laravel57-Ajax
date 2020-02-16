<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RequestCustomer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(RequestCustomer $request)
    {
        if ($request -> ajax()) {
            $data = $request -> only('name','email', 'phone', 'address');
            $data['user_id'] = Auth::user()-> id;
            if ($request -> active == 'on') {
                $data['active'] = 1;
                $customer = Customer::where('user_id', Auth::user() -> id)-> where('active', 1)->first();
            // nếu không trống thì ta cho active == 0
                if (!empty($customer)) {
                    $customer -> active = 0;
                    $customer ->save();
                }
            }
            else{
                $data['active'] = 0; 
            }
            Customer::create($data);
            return response()-> json(['result' => 'Đã thêm địa chỉ nhận hàng thành công.'], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
