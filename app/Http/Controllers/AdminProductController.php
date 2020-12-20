<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\ProductImage;
use App\Tag;
use App\Traits\StoreageImageTrait;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Components\Recusive;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class AdminProductController extends Controller
{
    use StoreageImageTrait;
    protected $category;
    protected $product;
    protected $productImage;
    public function __construct(
        Category $category,
        Product $product,
        ProductImage $productImage
    ) {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
    }
    public function index()
    {
        $data = $this->product->latest()->paginate(10);
        return view('admin.product.list', compact('data'));
    }

    public function create()
    {
        $htmlSelect = $this->handleCategorySelect();
        return view('admin.product.add',compact('htmlSelect'));
    }
    public function handleCategorySelect($id = 0, $currentCategory = 0)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlSelect = $recusive->categoryRecusive($id, $currentCategory);
        return $htmlSelect;
    }

    public function store(ProductAddRequest $request)
    {
        try{
            DB::beginTransaction();
            $dataUpload = $this->storageImgUpload($request, 'feature_image_path', 'product');
            $dataInsert = [
                'name' => $request->product_name,
                'price' => $request->product_price,
                'category_id' => $request->category,
                'content' => $request->contents,
                'user_id' => auth()->id(),
            ];
            if(!empty($dataUpload)) {
                $dataInsert['feature_image_name'] = $dataUpload['file_name'];
                $dataInsert['feature_image_path'] = $dataUpload['file_path'];
            }

            $product = $this->product->create($dataInsert);
            if($product->id) {
                // insert product image
                if($request->hasFile('gallery_image')) {
                    foreach($request->gallery_image as $imageFile) {
                        $imageInfo = $this->storageImgUploadMultile($imageFile, 'product_image');
                        // cách bthg để insert data cho table product image
//                    ProductImage::create([
//                        'product_id'=> $product->id,s
//                        'image_name' => $imageInfo['file_name'],
//                        'image_path' => $imageInfo['file_path']
//                    ]);

                        // trong trg hợp table này có foreign key ms table khac thì ta có thể call model của table này thông qua table kia
                        $product->images()->create([
                            'product_id'=> $product->id,
                            'image_name' => $imageInfo['file_name'],
                            'image_path' => $imageInfo['file_path']
                        ]);
                    }
                }

                //in sert product tag
                $tagsIds = [];
                if($request->tags) {
                    foreach($request->tags as $key => $tagItem) {
                        $tagInstance =  Tag::firstOrCreate([
                            'name'=>$tagItem
                        ]);
                        $tagsIds[] = $tagInstance->id;
                    }
                    $product->tags()->sync($tagsIds);
                }
            }
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Message: '.$e->getMessage(). 'Line: '.$e->getLine());
        }
        return redirect()->route('product.index');

    }

    public function edit($id)
    {
        try {
            $product = $this->product->find($id);
            if($product->id) {
                $htmlSelect = $this->handleCategorySelect(0, $product->category_id);
                return view('admin.product.edit',compact('product', 'htmlSelect'));
            }
        } catch (\Exception $e) {
            Log::error('Message: '.$e->getMessage(). 'Line: '.$e->getLine());
        }
        return redirect()->route('product.index');

    }

    public function update($id, Request $request )
    {
        try{
            DB::beginTransaction();
            $dataUpload = $this->storageImgUpload($request, 'feature_image_path', 'product');
            $dataUpdate = [
                'name' => $request->product_name,
                'price' => $request->product_price,
                'category_id' => $request->category,
                'content' => $request->contents,
                'user_id' => auth()->id(),
            ];
            if(!empty($dataUpload)) {
                $dataUpdate['feature_image_name'] = $dataUpload['file_name'];
                $dataUpdate['feature_image_path'] = $dataUpload['file_path'];
            }

            $this->product->find($id)->update($dataUpdate);
            $product = $this->product->find($id);
            if($product->id) {
                // insert product image
                if($request->hasFile('gallery_image')) {
                    $this->productImage->where('product_id', $id)->delete();
                    foreach($request->gallery_image as $imageFile) {
                        $imageInfo = $this->storageImgUploadMultile($imageFile, 'product_image');
                        // cách bthg để insert data cho table product image
//                    ProductImage::create([
//                        'product_id'=> $product->id,s
//                        'image_name' => $imageInfo['file_name'],
//                        'image_path' => $imageInfo['file_path']
//                    ]);

                        // trong trg hợp table này có foreign key ms table khac thì ta có thể call model của table này thông qua table kia
                        $product->images()->create([
                            'product_id'=> $product->id,
                            'image_name' => $imageInfo['file_name'],
                            'image_path' => $imageInfo['file_path']
                        ]);
                    }
                }

                //in sert product tag
                $tagsIds = [];
                if($request->tags) {
                    foreach($request->tags as $key => $tagItem) {
                        $tagInstance =  Tag::firstOrCreate([
                            'name'=>$tagItem
                        ]);
                        $tagsIds[] = $tagInstance->id;
                    }
                    $product->tags()->sync($tagsIds);
                }

            }
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Message: '.$e->getMessage(). 'Line: '.$e->getLine());
        }

        return redirect()->route('product.index');

    }

    public function delete($id)
    {
        $message = '';
        if($id) {
            try {
                $product = $this->product->find($id);
                $product->delete();
                $message = 'Delete product success.';
                return response()->json([
                    'code' =>200,
                    'message' => $message
                ], 200);
            } catch (\Exception $e) {
                $message = 'Error: '.$e->getMessage();
                return response()->json([
                    'code' =>500,
                    'message' => $message
                ]);
            }

        }
        return redirect()->route('product.index')->with('message', $message);
    }
}
