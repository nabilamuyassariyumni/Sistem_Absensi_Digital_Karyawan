<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::latest()->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|unique:employees',
            'name' => 'required',
            'email' => 'nullable|email|unique:employees',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {

            $photoName = time() . '.' .
                $request->photo->extension();

            $request->photo->move(
                public_path('uploads/employees'),
                $photoName
            );

            $data['photo'] = $photoName;
        }

        Employees::create($data);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employees::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employees::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employees $employee)
    {
        $request->validate([
            'employee_id' => 'required|unique:employees,employee_id,' . $employee->id,
            'name' => 'required',
            'email' => 'nullable|email|unique:employees,email,' . $employee->id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {

            if (
                $employee->photo &&
                file_exists(public_path('uploads/employees/' . $employee->photo))
            ) {

                unlink(public_path('uploads/employees/' . $employee->photo));
            }

            $photoName = time() . '.' .
                $request->photo->extension();

            $request->photo->move(
                public_path('uploads/employees'),
                $photoName
            );

            $data['photo'] = $photoName;
        }

        $employee->update($data);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data karyawan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employees $employee)
    {
        // Hapus foto jika ada
        if (
            $employee->photo &&
            file_exists(public_path('uploads/employees/' . $employee->photo))
        ) {
            unlink(public_path('uploads/employees/' . $employee->photo));
        }

        // Hapus data karyawan
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }
}
