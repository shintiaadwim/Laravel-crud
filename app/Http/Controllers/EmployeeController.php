<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Employee;
use App\Models\Religion;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('nama', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('halaman_url', request()>$request->fullUrl());
        } else {
            $data = Employee::paginate(5);
            Session::put('halaman_url', request()>$request->fullUrl());
        }
        return view('datapegawai', compact('data'));
    }

    public function show()
    {
        $dataagama = Religion::all();
        return view('add-data', compact('dataagama'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:7|max:20',
            'notelpon' => 'required|min:11|max:12',
        ]);

        $data = Employee::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('pegawai')->with('success', 'Data Berhasil di Tambahkan!');
    }

    public function edit($id)
    {
        $data = Employee::find($id);
        return view('edit-data', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Employee::find($id);
        $data->update($request->all());
        if(session('halaman_url')){
            return Redirect(session('halaman_url'))->with('success', 'Data Berhasil di Update!');
        }

        return redirect()->route('pegawai')->with('success', 'Data Berhasil di Update!');
    }

    public function delete($id)
    {
        $data = Employee::find($id);
        $data->delete();

        return redirect()->route('pegawai')->with('success', 'Data Berhasil di Hapus!');
    }

    public function exportpdf()
    {
        $data = Employee::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('data.pdf');
    }

    public function exportexcel()
    {
        return Excel::download(new EmployeeExport, 'datapegaawai.xlsx');
    }

    public function importexcel(Request $request)
    {
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('EmployeeData', $namafile);

        Excel::import(new EmployeeImport, \public_path('/EmployeeData/'.$namafile));
        return \redirect()->back();
    }
}
