<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        $customers = Customer::latest()->when(request()->q, function($customers) {
            $customers = $customers->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.customer.index', compact('customers'));
    }

    /**
    * show
    *
    * @param  int  $id
    * @return void
    */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customer.show', compact('customer'));
    }

    /**
    * destroy
    *
    * @param  int  $id
    * @return void
    */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customer.index')->with('success', 'Customer deleted successfully');
    }
}