<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Exception;

class OrderController extends Controller
{
    const WAITING = "waiting";
    const COMPLETE = "complete";
    const STATUS = [
        self::WAITING,
        self::COMPLETE
    ];
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $searchTerm = $request->get('search');

        $orders = OrderResource::collection($this->orderService->getAll($searchTerm));

        $count = $orders->resource->lastPage();
        $currentPage = $orders->resource->currentPage();
        $previous = $currentPage - 1;
        if ($previous == 0) {
            $previous = $currentPage;
        }
        $next = $currentPage + 1;
        if ($next == $count) {
            $next = $currentPage;
        }
        $data = [
            'orders' => $orders,
            'count' => $count,
            'currentPage' => $currentPage,
            'previous' => $previous,
            'next' => $next
        ];

        return response()->json($data);
    }

    public function edit($id)
    {
        $status = self::STATUS;
        $order = $this->orderService->getSingle($id);
        $data = [
            'order' => $order,
            'status' => $status
        ];
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {

        $req = $request->only(['status']);
        $order = ['status' => 200];
        try {
            $order['data'] = $this->orderService->update($id, $req);
        } catch (Exception $e) {
            $order = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($order, $order['status']);
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
