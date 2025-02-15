<?php

namespace App\Http\Controllers\Admin;

use App\Models\CodeVoucher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{

    public function index()
    {
        $data = [
            'voucher' => CodeVoucher::orderBy('id', 'desc')->paginate(20),
            'counts' => CodeVoucher::count()
        ];

        return view('pages.Admin.v_voucher.index', $data)->with('page', 'voucher');
    }


    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => CodeVoucher::findOrFail($id),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:6|unique:code_vouchers,code',
                'percent' => 'required|integer|min:0|max:100',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'code.required' => 'Kode voucher harus diisi.',
                'code.max' => 'Kode voucher maksimal 6 karakter.',
                'percent.required' => 'Persentase harus diisi.',
                'code.unique' => 'Kode voucher sudah terdaftar.',
                'percent.integer' => 'Persentase harus berupa angka.',
                'percent.max' => 'Persentase tidak boleh lebih dari 100.',
                'percent.min' => 'Persentase tidak boleh kurang dari 0.',
            ]
        );

        $cat = new CodeVoucher();
        $cat->name = $request->name;
        $cat->code = $request->code;
        $cat->percent = $request->percent;
        $cat->save();
        return redirect()->back()->with('success', 'Code Voucher berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:6|unique:code_vouchers,code,' . $id,
                'percent' => 'required|integer|min:0|max:100',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'code.required' => 'Kode voucher harus diisi.',
                'code.max' => 'Kode voucher maksimal 6 karakter.',
                'percent.required' => 'Persentase harus diisi.',
                
                'percent.integer' => 'Persentase harus berupa angka.',
                'percent.max' => 'Persentase tidak boleh lebih dari 100.',
                'percent.min' => 'Persentase tidak boleh kurang dari 0.',
            ]
        );

        $cat = CodeVoucher::findOrFail($id);
        $cat->code = $request->code;
        $cat->percent = $request->percent;
        $cat->save();
        return redirect('/voucher')->with('success', 'Code Voucher berhasil diupdate.');
    }

    

    public function destroy($id)
    {
        $cat = CodeVoucher::findOrFail($id);
        $cat->delete();
        return redirect()->back()->with('success', 'Code Voucher berhasil dihapus.');
    }
}
