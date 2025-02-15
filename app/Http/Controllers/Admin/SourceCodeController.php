<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use App\Models\ImagesDemo;
use App\Models\Technology;
use App\Models\SourceCodes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\FirebaseStorage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SourceCodeController extends Controller
{

    // protected $firebaseStorage;

    // public function __construct(FirebaseStorage $firebaseStorage)
    // {
    //     $this->firebaseStorage = $firebaseStorage;
    // }
    
    public function index()
    {
        $data = [
            'source_codes' => SourceCodes::orderBy('id', 'desc')->paginate(20),
            'counts' => SourceCodes::count(),
        ];

        return view('pages.Admin.v_source_codes.index', $data)->with('page', 'project');
    }

    public function create()
    {
        $data = [
            'technologies' => Technology::orderBy('id', 'desc')->get(),
            'categories' => Categories::orderBy('id', 'desc')->get(),
        ];

        return view('pages.Admin.v_source_codes.create', $data)->with('page', 'project');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'categories' => 'required|array',
                'technologies' => 'required|array',
                'price' => 'required|string|max:255',
                'thumbnail' => 'required|image',
            ],
            [
                'title.required' => 'Nama harus diisi.',
                'categories.required' => 'Kategori harus diisi minimal 1.',
                'technologies.required' => 'Teknologi harus diisi minimal 1.',
                'price.required' => 'Harga harus diisi.',
                'thumbnail.required' => 'Berikan thumbanil aplikasi',
            ],
        );

        // Upload thumbnail
        $thumbnailFileName = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
        $thumbnailPath = $request->file('thumbnail')->storeAs('app-assets/thumbnail', $thumbnailFileName, 'public');

        $script = SourceCodes::create([
            'slug' => Str::slug($request->title, '-') . '-' . Str::random(5) . '-' . time(),
            'thumbnail' => $thumbnailPath,
            'title' => $request->title,
            'categories' => json_encode($request->categories),
            'technologies' => json_encode($request->technologies),
            'price' => $request->price,
            'user_id' => Auth::user()->id,
        ]);

        return redirect("/source_codes/admin/step/2/$script->slug")->with('success', 'Berhasil disave dan lanjutkan.');
    }

    public function step($step, $slug)
    {
        $sc = SourceCodes::where('slug', $slug)
            ->with(['assets', 'createdBy'])
            ->first();
        if (!$sc) {
            abort(404);
        }

        if ($step <= '0') {
            abort(403);
        }

        $data = [
            'technologies' => Technology::orderBy('id', 'desc')->get(),
            'categories' => Categories::orderBy('id', 'desc')->get(),
            'sc' => $sc,
            'step' => $step == 1 ? '2' : $step,
        ];

        return view('pages.Admin.v_source_codes.step', $data)->with('page', 'project');
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'technologies' => 'nullable|array',
            'price' => 'nullable|string|max:255',
            'desc' => 'nullable',
            'thumbnail' => 'nullable|image',
            'file_project' => 'nullable',
            'assets_images_demo' => 'nullable',
            'assets_images_desc' => 'nullable',
        ]);

        $sc = SourceCodes::where('slug', $slug)->first();

        $thumbnailPath = $sc->thumbnail;
        $projectPath = $sc->file_url;

        if ($request->hasFile('thumbnail')) {
            $thumbnailFileName = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
            $thumbnailPath = $request->file('thumbnail')->storeAs('thumbnail', $thumbnailFileName, 'public');
        }

        if ($request->hasFile('file_project')) {
            $projectFileName = time() . '_' . $request->file('file_project')->getClientOriginalName();
            $projectPath = $request->file('file_project')->storeAs('file-project', $projectFileName, 'public');
        }

        $sc->update([
            'slug' => $sc->slug ?? Str::slug($request->title, '-') . '-' . Str::random(5) . '-' . time(),
            'thumbnail' => $thumbnailPath,
            'title' => $request->title ?? $sc->title,
            'description' => $request->desc ?? $sc->description,
            'categories' => $request->categories ? json_encode($request->categories) : $sc->categories,
            'technologies' => $request->technologies ? json_encode($request->technologies) : $sc->technologies,
            'price' => $request->price ?? $sc->price,
            'file_url' => $projectPath,
            'user_id' => Auth::user()->id,
        ]);

        if ($request->assets_images_demo) {
            foreach ($request->assets_images_demo as $index => $fileData) {
                if (isset($fileData['file'])) {
                    $file = $fileData['file'];
                    $caption = $fileData['caption'] ?? '';

                    $projectFileName = time() . '_' . $file->getClientOriginalName();
                    $projectPath = $file->storeAs('app-assets/image-demos', $projectFileName, 'public');

                    ImagesDemo::create([
                        'image' => $projectPath,
                        'caption' => $caption,
                        'sc_id' => $sc->id,
                    ]);
                }
            }
        }

        if ($request->step >= 5) {
            $sc->update(['status' => '1']);
            return response()->json([
                'status' => 'success',
                'message' => 'Source code berhasil dipublish',
                'redirect' => '/source_codes/admin',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Progress disimpan',
            'redirect' => "/source_codes/admin/step/$request->step/$sc->slug",
        ]);
    }

    public function status($id)
    {
        $sc = SourceCodes::find($id);
        if (!$sc) {
            abort(404);
        }
        $sc->update([
            'status' => $sc->status == '1' ? '0' : '1',
        ]);

        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function destroy_file($id)
    {
        $sc = SourceCodes::findOrFail($id);

        if (!empty($sc->file_url) && file_exists(public_path('storage/' . $sc->file_url))) {
            unlink(public_path('storage/' . $sc->file_url));
        }

        $sc->update(['file_url' => null]);

        return redirect()->back()->with('success', 'SourceCodes berhasil dihapus.');
    }

    public function destroy_asset($id)
    {
        $asset = ImagesDemo::findOrFail($id);

        if (!empty($asset->image) && file_exists(public_path('storage/' . $asset->image))) {
            unlink(public_path('storage/' . $asset->image));
        }
        $asset->delete();

        return redirect()->back()->with('success', 'Asset berhasil dihapus.');
    }

    public function destroy($id)
    {
        $cat = SourceCodes::findOrFail($id);
        $cat->delete();
        return redirect()->back()->with('success', 'SourceCodes berhasil dihapus.');
    }
}
