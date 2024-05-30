<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Http\Requests\StoreBrandsRequest;
use App\Http\Requests\UpdateBrandsRequest;

class BrandsController extends Controller
{
    const PATH_VIEW = "brands.";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brands::query()->latest('id')->paginate(3);
        return view(self::PATH_VIEW . __FUNCTION__, compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandsRequest $request)
    {
        $data = $request->all();
        $request->validate(
            [
                "name" => "required|min:5|unique:brands,name",
                "image" => "mimes:png,jpg,jpeg,webp"
            ],
            [
                "name.required" => "Name is empty",
                "name.min" => "Name need to be at least :min characters",
                "name.unique" => "The name has already been taken",
                "image.mimes" => "Only select PNG, JPG, JPEG, WEBP images"
            ]
        );

        if ($request->hasFile("image")) {
            $file = $request->image;
            $ext = $file->getClientOriginalExtension();
            $filename = time() . "." . $ext;
            $file->storeAs("public", $filename);
        }

        if (isset($filename)) {
            $data["image"] = $filename;
        } else {
            $data["image"] = "";
        }

        $is_create = Brands::create(
            [
                "name" => $data["name"],
                "image" => $data["image"],
            ]
        );
        if ($is_create) {
            return redirect()->route('brands.index')->with('success', 'Create a brand successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brands $brand)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact("brand"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brands $brand)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact("brand"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandsRequest $request, Brands $brand)
    {
        $data = $request->all();

        $request->validate(
            [
                "name" => "required|min:5|unique:brands,name",
                "image" => "mimes:png,jpg,jpeg,webp"
            ],
            [
                "name.required" => "Name is empty",
                "name.min" => "Name need to be at least :min characters",
                "name.unique" => "The name has already been taken",
                "image.mimes" => "Only select PNG, JPG, JPEG, WEBP images"
            ]
        );

        if ($request->hasFile("image")) {
            $file = $request->image;
            $ext = $file->getClientOriginalExtension();
            $filename = time() . "." . $ext;
            $file->storeAs("public", $filename);
            $data["image"] = $filename;
        } else {
            $data["image"] = $brand->image;
        }

        $is_update = Brands::findOrFail($brand->id)->update(
            [
                "name" => $data["name"],
                "image" => $data["image"],
            ]
        );
        if ($is_update) {
            return redirect()->back()->with('success', 'Update a brand successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brands $brand)
    {
        $brand->delete();
        return redirect()->back()->with('success', 'Delete brand successfully');
    }
}
