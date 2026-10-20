<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        $request->validate(['name' => 'required']); // Validasi nama departemen
        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Departemen berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $request->validate(['name' => 'required']);
        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Departemen berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
         // Menangani penghapusan secara aman jika departemen memiliki pegawai
        if ($department->employees()->count() > 0) {
            return redirect()->route('departments.index')->with('error', 'Gagal menghapus! Departemen masih memiliki pegawai.');
        }
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Departemen berhasil dihapus.');
    }
}
