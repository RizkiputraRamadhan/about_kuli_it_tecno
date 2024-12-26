<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => Categories::orderBy('id', 'desc')->paginate(20),
            'counts' => Categories::count()
        ];

        return view('pages.Admin.v_categories.index', $data);
    }


    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => Categories::findOrFail($id),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Nama harus diisi.',
            ],
        );

        $cat = new Categories();
        $cat->name = $request->name;
        $cat->slug = Str::slug($request->name, '-');;
        $cat->save();
        return redirect()->back()->with('success', 'Categories berhasil ditambahkan.');
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

        $cat = Categories::findOrFail($id);
        $cat->slug = Str::slug($request->name, '-');
        $cat->save();
        return redirect('/categories')->with('success', 'Categories berhasil diupdate.');
    }

    

    public function destroy($id)
    {
        $cat = Categories::findOrFail($id);
        $cat->delete();
        return redirect()->back()->with('success', 'Categories berhasil dihapus.');
    }
}
