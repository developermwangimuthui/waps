<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $customers = Customer::with('campaigns', 'user')->get();
        // dd($customers);

        $allCustomerCount = $this->allCustomersCount();
        return view('customer.index', compact('customers', 'allCustomerCount'));
    }

    public function create()
    {
        return view('customer.create');
    }
    public function edit($customer_id)
    {
        $customers = Customer::with('user', 'campaigns')->where('id', $customer_id)->get();
        // dd($customers);
        return view('customer.edit', compact('customers'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->password = Hash::make($request->phone);
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->user_type = 3;
        $user->status = 1;
        $user->first_name = $request->first_name;
        $user->surname = $request->surname;
        $user->country = $request->country;
        $user->county = $request->county;
        if ($user->save()) {
            $customer = new Customer();
            $customer->user_id = $user->id;
            $customer->contact_number2 = $request->input('contact_number2');
            if ($customer->save()) {
                return redirect()->route('customer.index')->with(['success' => 'Customer Added Sussecfully']);
            } else {
                return redirect()->route('customer.create')->with(['success' => 'Customer not Added ']);
            }
        }
    }

    public function allCustomersCount()
    {
        return User::with('customers')->where([
            ['user_type', '=', 3],
            ['status', '=', 1],
        ])->count();
    }

    public function update(Request $request, $user_id)
    {
        if (User::where('id', $user_id)->update([
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'country' => $request->country,
            'county' => $request->county,
            'email' => $request->email,
            'phone' => $request->phone,

        ])) {
            return redirect()->route('customer.index')->with(['success' => 'Customer Updated Succesfully']);
        } else {
            return redirect()->back()->with(['error' => 'Customer not updated']);
        }
    }
    public function show(Request $request,$customer_id)
    {

        $customers = Customer::with('campaigns', 'user')->where('id',$customer_id)->get();
        // dd($customers);

    }
}
