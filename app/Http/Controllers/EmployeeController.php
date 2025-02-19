<?php

// app/Http/Controllers/EmployeeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('role', 'Employee')->get(); 
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required'
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'role' => 'Employee', // Role otomatis Employee
            'password' => bcrypt('employee'), // Password default
        ]);
    
        return redirect('/admin/employees')->with('success', 'Employee berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'required',
            'role' => 'required',
        ]);

        $employee = User::findOrFail($id);
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'role' => $request->role,
        ]);

        return redirect('/admin/employees')->with('success', 'Employee berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/admin/employees')->with('success', 'Employee berhasil dihapus.');
    }
}
