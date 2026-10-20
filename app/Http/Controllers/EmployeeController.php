<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Menyertakan relasi nama departemen via Eager Loading
        $employees = Employee::with('department')->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        // Semua poin validasi wajib sesuai soal
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric|gt:0',
            'joined_at' => 'required|date',
            'department_id' => 'required|exists:departments,id'
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
         $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
         $request->validate([
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric|gt:0',
            'joined_at' => 'required|date',
            'department_id' => 'required|exists:departments,id'
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
         $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
