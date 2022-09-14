<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $searchTerm = $request->get('search');

        $categories = CategoryResource::collection($this->categoryService->getAll($searchTerm));

        $count = $categories->resource->lastPage();
        $currentPage = $categories->resource->currentPage();
        $previous = $currentPage - 1;
        if ($previous == 0) {
            $previous = $currentPage;
        }
        $next = $currentPage + 1;
        if ($next == $count) {
            $next = $currentPage;
        }
        $data = [
            'categories' => $categories,
            'count' => $count,
            'currentPage' => $currentPage,
            'previous' => $previous,
            'next' => $next
        ];

        return response()->json($data);
    }

    public function create()
    {

        return view('admin.category.category_add');
    }

    public function store(CategoryRequest $categoryRequest)
    {
        $req = $categoryRequest;

        $category = ['status' => 200];

        try {
            $category['data'] = $this->categoryService->create($req);
        } catch (Exception $e) {
            $category = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($category, $category['status']);
    }

    public function edit($slug)
    {

        $category = $this->categoryService->getSingle($slug);

        return response()->json($category);
    }

    public function update(CategoryRequest $categoryRequest, $id)
    {

        $req = $categoryRequest->only(['name']);
        $category = ['status' => 200];
        try {
            $category['data'] = $this->categoryService->update($id, $req);
        } catch (Exception $e) {
            $category = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($category, $category['status']);
        // return redirect()->route('category.list')->with('success', 'Loại sản phẩm đã được cập nhật thành công');
    }

    public function delete($id)
    {
        $category = ['status' => 200];
        try {
            $category['data'] = $this->categoryService->delete($id);
        } catch (Exception $e) {
            $category = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($category, $category['status']);
        // return redirect()->back()->with('success', 'Loại sản phẩm đã được xóa thành công');
    }
}
