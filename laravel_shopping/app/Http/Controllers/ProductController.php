<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Services\ProductService;
use App\Traits\StorageImage;
use Exception;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use StorageImage;

    protected $serviceProduct;

    public function __construct(ProductService $productService)
    {
        $this->serviceProduct = $productService;
    }

    public function index(HttpRequest $request)
    {
        $searchTerm = $request->get('search');
        $products = ProductResource::collection($this->serviceProduct->getAll($searchTerm));

        $count = $products->resource->lastPage();
        $currentPage = $products->resource->currentPage();
        $previous = $currentPage - 1;
        if ($previous == 0) {
            $previous = $currentPage;
        }
        $next = $currentPage + 1;
        if ($next == $count) {
            $next = $currentPage;
        }
        $data = [
            'products' => $products,
            'count' => $count,
            'currentPage' => $currentPage,
            'previous' => $previous,
            'next' => $next
        ];

        return response()->json($data);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.product.product_add', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        // $data = $request->all();
        // $validator = Validator::make($data, [
        //     'name' => 'required|max:100|unique:products,name,null',
        //     'code' => 'required|max:50',
        //     'description' => 'required|max:500',
        //     'image_url' => 'required|max:255',
        //     'price' => 'required',
        // ], [
        //     'name.required' => 'Vui lòng nhập tên sản phẩm',
        //     'name.max' => 'Tên dài quá 100 ký tự',
        //     'name.unique' => 'Tên đã tồn tại',
        //     'code.required' => 'Vui lòng nhập mã sản phẩm',
        //     'code.max' => 'Mã dài quá 50 ký tự',
        //     'description.required' => 'Vui lòng nhập mô tả',
        //     'description.max:500' => 'Mô tả dài quá 500 ký tự',
        //     'image_url.required' => 'Vui lòng chọn ảnh',
        //     'image_url.max:255' => 'Đường dẫn ảnh sai',
        //     'price.required' => 'Vui lòng nhập giá sản phẩm',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['code' => 403, 'mess' => $validator->getMessageBag()]);
        // } else {
        $req = $request;

        $result = ['status' => 200];

        try {
            $result['data'] = $this->serviceProduct->create($req);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function edit($slug)
    {
        $result = $this->serviceProduct->getSingle($slug);
        $tag = [];
        $categories = Category::all();
        foreach ($result->tags as $tags) {
            array_push($tag, $tags->name);
        }
        $data = [
            'product' => $result,
            'tags' => $tag,
            'categories' => $categories
        ];

        return response()->json($data);
    }

    public function update(ProductRequest $productRequest, $id)
    {
        $req = $productRequest;

        $result = ['status' => 200];

        try {
            $result['data'] = $this->serviceProduct->update($id, $req);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function delete($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] =  $this->serviceProduct->delete($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
