<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TechnologyController extends Controller
{
    public function index()
    {
        $data = [
            'technology' => Technology::orderBy('id', 'desc')->paginate(20),
            'counts' => Technology::count()
        ];

        return view('pages.Admin.v_technology.index', $data);
    }


    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => Technology::findOrFail($id),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'color' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'color.required' => 'Nama harus diisi.',
            ],
        );

        $tech = new Technology();
        $tech->name = $request->name;
        $tech->color = $request->color;
        $tech->slug = Str::slug($request->name, '-');;
        $tech->save();
        return redirect()->back()->with('success', 'Technology berhasil ditambahkan.');
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

        $tech = Technology::findOrFail($id);
        $tech->name = $request->name;
        $tech->color = $request->color;
        $tech->slug = Str::slug($request->name, '-');
        $tech->save();
        return redirect('/technology')->with('success', 'Technology berhasil diupdate.');
    }

    

    public function destroy($id)
    {
        $tech = Technology::findOrFail($id);
        $tech->delete();
        return redirect()->back()->with('success', 'Technology berhasil dihapus.');
    }
}
