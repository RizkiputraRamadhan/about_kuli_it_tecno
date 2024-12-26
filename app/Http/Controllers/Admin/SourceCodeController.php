<?php

namespace App\Http\Controllers\Admin;

use App\Models\SourceCodes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Technology;

class SourceCodeController extends Controller
{
    public function index()
    {
        $data = [
            'source_codes' => SourceCodes::orderBy('id', 'desc')->paginate(20),
            'counts' => SourceCodes::count()
        ];

        return view('pages.Admin.v_source_codes.index', $data);
    }

    public function create()
    {
        $data = [
            'technologies' => Technology::orderBy('id', 'desc')->get(),
            'categories' => Categories::orderBy('id', 'desc')->get(),
        ];

        return view('pages.Admin.v_source_codes.create', $data);
    }


    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => SourceCodes::findOrFail($id),
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate(
            [
                'name' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Nama harus diisi.',
            ],
        );

        $cat = new SourceCodes();
        $cat->name = $request->name;
        $cat->slug = Str::slug($request->name, '-');;
        $cat->save();
        return redirect()->back()->with('success', 'SourceCodes berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Nama harus diisi.',
            ],
        );

        $cat = SourceCodes::findOrFail($id);
        $cat->slug = Str::slug($request->name, '-');
        $cat->save();
        return redirect('/source_code')->with('success', 'SourceCodes berhasil diupdate.');
    }

    

    public function destroy($id)
    {
        $cat = SourceCodes::findOrFail($id);
        $cat->delete();
        return redirect()->back()->with('success', 'SourceCodes berhasil dihapus.');
    }
}
