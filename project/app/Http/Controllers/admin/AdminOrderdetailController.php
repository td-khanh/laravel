<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Orderdetail;
use App\Models\clients\Ordered;
use Illuminate\Http\Request;

class AdminOrderdetailController extends Controller
{
    public function index($id)
    {
        $order = Ordered::with(['orderdetails.product']) // Tải dữ liệu chi tiết đơn hàng và sản phẩm
            ->findOrFail($id);
        $pending_count = Ordered::where('Status', 1)->count();
        $pickup_count = Ordered::where('Status', 2)->count();
        $shipping_count = Ordered::where('Status', 3)->count();
        $delivered_count = Ordered::where('Status', 4)->count();
        $cancelled_count = Ordered::where('Status', 5)->count();
        $total_orders = Ordered::count();
        $statuses = [
            1 => ['text' => 'Đang xử lý', 'color' => 'blue'],
            2 => ['text' => 'Đang giao hàng', 'color' => 'orange'],
            3 => ['text' => 'Đã giao', 'color' => 'green'],
            4 => ['text' => 'Đã hủy', 'color' => 'red'],
        ];
        return view('admin/orderdetail', compact('order', 'statuses', 'total_orders', 'pending_count', 'pickup_count', 'shipping_count', 'delivered_count', 'cancelled_count'));
        //return view('admin/orderdetail', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {

        // Validate input (bắt buộc phải có status hợp lệ)
        $request->validate([
            'status' => 'required|in:1,2,3,4,5,6'
        ]);

        // Tìm đơn hàng
        $order = Ordered::findOrFail($id);

        // Nếu đã giao hoặc hủy thì không cập nhật nữa
       
        if (in_array($order->Status, [4, 6])) {
            return redirect()->back()->with('error', 'Không thể thay đổi trạng thái vì đơn hàng đã được giao hoặc đã hủy.');
        }

        // Cập nhật trạng thái
        $order->Status = $request->input('status');
        $order->save();

        //return redirect()->route('admin.orderdetail', $id)->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
        return redirect()->route('admin.orderdetail', $id)->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }
}
