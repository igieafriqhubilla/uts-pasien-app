<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
// when() hanya menjalankan filter jika ?search=... ada isinya
$patients = Patient::when($request->search, function ($query, $search) {
$query->where(function ($q) use ($search) {
$q->where('nama', 'like', "%{$search}%")->orWhere('no_rm', 'like', "%{$search}%");
});
})->latest()->paginate(10)->withQueryString();
return inertia('Patients/Index', [
'patients' => $patients,
'search' => $request->search, // dikirim balik agar kotak pencarian 
//tetap terisi
]);
}
public function create()
{
    return inertia('Patients/Create');
}
public function store(Request $request)
{
    // 1. validasi di sisi server
    $validated = $request->validate([
        'no_rm'    => 'required|unique:patients',
        'nama'     => 'required|max:255',
        'usia'     => 'required|integer|min:0|max:150',
        'alamat'   => 'required|max:255',
        'diagnosa' => 'required|max:255',
    ]);
    // 2. simpan sebagai baris baru
    Patient::create($validated);
    // 3. kembali ke daftar pasien dengan pesan sukses
    return redirect()->route('patients.index')->with('success', 'Pasien 
berhasil ditambahkan');
}
    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
{
    // $patient otomatis terisi lewat Route Model Binding
    return inertia('Patients/Edit', [
        'patient' => $patient,
    ]);
}
public function update(Request $request, Patient $patient)
{
    $validated = $request->validate([
        // unique mengecualikan id pasien ini sendiri
        'no_rm'    => 'required|unique:patients,no_rm,' . $patient->id,
        'nama'     => 'required|max:255',
        'usia'     => 'required|integer|min:0|max:150',
        'alamat'   => 'required|max:255',
        'diagnosa' => 'required|max:255',
    ]);
    $patient->update($validated);
    return redirect()->route('patients.index')->with('success', 'Pasien 
berhasil diperbarui');
}
public function destroy(Patient $patient)
{
    $patient->delete();
    return redirect()->route('patients.index')->with('success', 'Pasien 
berhasil dihapus');
}
}
