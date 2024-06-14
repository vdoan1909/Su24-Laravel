<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const PATH_VIEW = "admin.product.";
    const PATH_UPDATE = "product";
    public function index()
    {
        $data = Product::with(['catalogue', 'tags'])->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        $catalogues = Catalogue::pluck('name', 'id')->all();
        $colors = ProductColor::pluck('name', 'id')->all();
        $sizes = ProductSize::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'id')->all();
        return view(
            self::PATH_VIEW . __FUNCTION__,
            compact(
                'catalogues',
                'colors',
                'sizes',
                'tags',
            )
        );
    }

    public function store(Request $request)
    {
        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
        $dataProduct['is_active'] = isset($request->is_active) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($request->is_hot_deal) ? 1 : 0;
        $dataProduct['is_good_deal'] = isset($request->is_good_deal) ? 1 : 0;
        $dataProduct['is_new'] = isset($request->is_new) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($request->is_show_home) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . "-" . Str::slug($dataProduct['sku']);

        if ($dataProduct['img_thumbnail']) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }
        // dd($dataProduct);

        $dataVariantTmp = $request->product_variants;
        $dataProductVariants = [];

        foreach ($dataVariantTmp as $key => $item) {
            if (!is_null($item['quantity']) && $item['quantity'] != '') {
                $tmp = explode('-', $key);
                $dataProductVariants[] = [
                    'product_size_id' => $tmp[0],
                    'product_color_id' => $tmp[1],
                    'quantity' => $item['quantity'],
                    'image' => $item['image'] ?? null,
                ];
            }
        }

        // dd($dataProductVariants);

        $dataProductTag = $request->tags;
        $dataProductGallery = $request->product_galleries ?: [];

        try {
            DB::beginTransaction();
            $product = Product::create($dataProduct);

            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;

                if ($dataProductVariant['image']) {
                    $dataProductVariant['image'] = Storage::put('products', $dataProductVariant['image']);
                }

                ProductVariant::create($dataProductVariant);
            }

            $product->tags()->sync($dataProductTag);

            foreach ($dataProductGallery as $item) {

                if ($item) {
                    $item = Storage::put('products', $item);
                }

                ProductGallery::create(
                    [
                        'product_id' => $product->id,
                        'image' => $item
                    ]
                );
            }

            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return back();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $product = Product::with(["catalogue", "variants", "galleries", "tags"])->findOrFail($id);
        $catalogues = Catalogue::pluck('name', 'id')->all();
        $colors = ProductColor::pluck('name', 'id')->all();
        $sizes = ProductSize::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'id')->all();

        $selectedTags = $product->tags->pluck('id')->toArray();

        return view(self::PATH_VIEW . __FUNCTION__, compact('catalogues', 'colors', 'sizes', 'tags', 'product', 'selectedTags'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
        $dataProduct['is_active'] = isset($request->is_active) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($request->is_hot_deal) ? 1 : 0;
        $dataProduct['is_good_deal'] = isset($request->is_good_deal) ? 1 : 0;
        $dataProduct['is_new'] = isset($request->is_new) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($request->is_show_home) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . "-" . Str::slug($dataProduct['sku']);

        if ($request->hasFile('img_thumbnail')) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $request->img_thumbnail);
        }

        try {
            DB::beginTransaction();

            $product->update($dataProduct);

            if ($request->has('product_variants')) {
                foreach ($request->product_variants as $key => $variant) {
                    if (!is_null($variant['quantity'])) {
                        $tmp = explode('-', $key);
                        $variant['product_size_id'] = $tmp[0];
                        $variant['product_color_id'] = $tmp[1];

                        if (isset($variant['image'])) {
                            $variant['image'] = Storage::put('products', $variant['image']);
                        }

                        ProductVariant::updateOrCreate(
                            [
                                'product_id' => $product->id,
                                'product_size_id' => $variant['product_size_id'],
                                'product_color_id' => $variant['product_color_id'],
                            ],
                            $variant
                        );
                    }
                }
            }

            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
            } else {
                $product->tags()->sync($product->tags);
            }

            if ($request->has('product_galleries')) {
                foreach ($request->product_galleries as $img) {
                    if ($img != null) {
                        $imgPath = Storage::put('products', $img);
                        ProductGallery::updateOrCreate(['product_id' => $product->id], ['image' => $imgPath]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return back();
        }
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        try {
            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);
                $product->galleries()->delete();
                $product->variants()->delete();
                $product->delete();
            }, 2);
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }
}
