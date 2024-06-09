<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Catalogue;

class CatalogueController extends Controller
{
    const PATH_VIEW = "admin.catalogues.";
    const PATH_UPDATE = "catalogues";
    public function index()
    {
        $data = Catalogue::latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(Request $request)
    {
        $data = $request->except('cover');
        $data['is_active'] = $request->is_active ? 1 : 0;

        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put(self::PATH_UPDATE, $request->file('cover'));
        }

        Catalogue::create($data);
        return redirect()->route('admin.catalogues.index')->with('success', "Create catalogue successfully");

    }

    public function show(string $id)
    {
        $model = Catalogue::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    public function edit(string $id)
    {
        $model = Catalogue::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    public function update(Request $request, string $id)
    {
        $model = Catalogue::findOrFail($id);
        $data = $request->except('cover');
        $data['is_active'] = $request->is_active ? 1 : 0;

        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put(self::PATH_UPDATE, $request->file('cover'));
        }

        $currentCover = $model->cover;
        $model->update($data);

        if ($request->hasFile('cover') && $currentCover && Storage::exists($currentCover)) {
            Storage::delete($currentCover);
        }

        return redirect()->back()->with('success', "Update catalogue successfully");
    }

    public function destroy(string $id)
    {
        $model = Catalogue::findOrFail($id);

        $model->delete();

        if ($model->cover && Storage::exists($model->cover)) {
            Storage::delete($model->cover);
        }

        return redirect()->back()->with('success', "Delete catalogue successfully");
    }
}
