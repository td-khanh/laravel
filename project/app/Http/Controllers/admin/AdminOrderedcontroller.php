<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Ordered;

class AdminOrderedcontroller extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');

        $query = Ordered::query();

        if (!empty($status)) {
            $query->where('Status', $status);
        }


        $ordered_list = $query->get();

        $statuses = [
            1 => ['text' => 'Chờ xác nhận', 'color' => 'blue'],
            2 => ['text' => 'Chờ lấy hàng', 'color' => 'orange'],
            3 => ['text' => 'Đang giao', 'color' => 'green'],
            6 => ['text' => 'Đã giao', 'color' => 'green'],
            4 => ['text' => 'Hủy', 'color' => 'red'],
            5 => ['text' => 'Hoàn', 'color' => 'purple'],
        ];

        $pending_count = Ordered::where('Status', 1)->count();
        $pickup_count = Ordered::where('Status', 2)->count();
        $shipping_count = Ordered::where('Status', 3)->count();
        $delivered_count = Ordered::where('Status', 4)->count();
        $total_orders = Ordered::count();

        return view('admin.orderd', compact(
            'ordered_list',
            'statuses',
            'total_orders',
            'pending_count',
            'pickup_count',
            'shipping_count',
            'delivered_count'
        ));
    }
    public function destroy(Request $request)
    {
        $status = $request->input('status');

        $query = Ordered::query();
        $query->where('Status', '4');

        if (!empty($status)) {
            $query->where('Status', $status);
        }


        $ordered_list = $query->get();

        $statuses = [
            1 => ['text' => 'Chờ xác nhận', 'color' => 'blue'],
            2 => ['text' => 'Chờ lấy hàng', 'color' => 'orange'],
            3 => ['text' => 'Đang giao', 'color' => 'green'],
            6 => ['text' => 'Đã giao', 'color' => 'green'],
            4 => ['text' => 'Hủy', 'color' => 'red'],
            5 => ['text' => 'Hoàn', 'color' => 'purple'],
        ];

        $pending_count = Ordered::where('Status', 1)->count();
        $pickup_count = Ordered::where('Status', 2)->count();
        $shipping_count = Ordered::where('Status', 3)->count();
        $delivered_count = Ordered::where('Status', 4)->count();
        $total_orders = Ordered::count();

        return view('admin.order.destroy', compact(
            'ordered_list',
            'statuses',
            'total_orders',
            'pending_count',
            'pickup_count',
            'shipping_count',
            'delivered_count'
        ));
    }

    public function momolist(Request $request)
    {
        $status = $request->input('status');

        $query = Ordered::query();
        $query->where('Shippingtype', 'Thanh toán bằng PayPal');

        if (!empty($status)) {
            $query->where('Status', $status);
        }


        $ordered_list = $query->get();

        $statuses = [
            1 => ['text' => 'Chờ xác nhận', 'color' => 'blue'],
            2 => ['text' => 'Chờ lấy hàng', 'color' => 'orange'],
            3 => ['text' => 'Đang giao', 'color' => 'green'],
            6 => ['text' => 'Đã giao', 'color' => 'green'],
            4 => ['text' => 'Hủy', 'color' => 'red'],
            5 => ['text' => 'Hoàn', 'color' => 'purple'],
        ];

        $pending_count = Ordered::where('Status', 1)->count();
        $pickup_count = Ordered::where('Status', 2)->count();
        $shipping_count = Ordered::where('Status', 3)->count();
        $delivered_count = Ordered::where('Status', 4)->count();
        $total_orders = Ordered::count();

        return view('admin.order.ordermomo', compact(
            'ordered_list',
            'statuses',
            'total_orders',
            'pending_count',
            'pickup_count',
            'shipping_count',
            'delivered_count'
        ));
    }
    public function search(Request $request)
    {
        // Lấy dữ liệu tìm kiếm từ request
        $searchTerm = $request->input('search');

        // Thực hiện tìm kiếm trong bảng orders
        $ordered_list = Ordered::query()
            ->where('OrderID', 'like', "%{$searchTerm}%")
            ->orWhere('FulName', 'like', "%{$searchTerm}%")
            ->orWhere('Phonenumber', 'like', "%{$searchTerm}%")
            ->orWhere('Address', 'like', "%{$searchTerm}%")
            ->get();

        // Statuses để hiển thị
        $statuses = [
            1 => ['text' => 'Đang xử lý', 'color' => 'blue'],
            2 => ['text' => 'Đang giao hàng', 'color' => 'orange'],
            3 => ['text' => 'Đã giao', 'color' => 'green'],
            4 => ['text' => 'Đã hủy', 'color' => 'red'],
        ];

        // Trả về view cùng kết quả tìm kiếm
        return view('admin/orderd', compact('ordered_list', 'statuses', 'searchTerm'));
    }
    public function getOrder()
    {
        $pending_count = Ordered::where('Status', 1)->count();
        $pickup_count = Ordered::where('Status', 2)->count();
        $shipping_count = Ordered::where('Status', 3)->count();
        $delivered_count = Ordered::where('Status', 4)->count();
        $total_orders = Ordered::count();


        $confirm = Ordered::where('Status', 1)->get();
        $confirm_count = Ordered::where('Status', 1)->count();

        $pickup = Ordered::where('Status', 2)->get();
        $pickup_cou = Ordered::where('Status', 2)->count();

        $transit = Ordered::where('Status', 3)->get();
        $transit_count = Ordered::where('Status', 3)->count();

        $cancelled = Ordered::where('Status', 4)->get();
        $cancelled_count = Ordered::where('Status', 4)->count();

        return view('admin/order/listreturn', compact(
            'cancelled_count',
            'cancelled',
            'total_orders',
            'pending_count',
            'pickup_count',
            'transit',
            'transit_count',
            'pickup_cou',
            'pickup',
            'confirm',
            'confirm_count',
            'shipping_count',
            'delivered_count',
            'cancelled_count'
        ));

        // return view('admin/order/listreturn',compact('cancelled_count','cancelled'));
    }
}
