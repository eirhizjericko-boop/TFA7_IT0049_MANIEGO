<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customerAccounts = Customer::orderBy('full_name')->get();

        return view('accounts.customers', compact('customerAccounts'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store()
    {
        $validated = request()->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer account created.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Customer $customer)
    {
        $validated = request()->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Customer account updated.');
    }
}
