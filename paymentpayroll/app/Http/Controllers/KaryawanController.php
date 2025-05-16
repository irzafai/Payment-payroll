<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('admin.karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('admin.karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans,email',
            'nomor_telepon' => 'nullable',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        Karyawan::create($request->all());

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit(Karyawan $karyawan)
    {
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'nomor_telepon' => 'nullable',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        $karyawan->update($request->all());

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil diubah.');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
};

