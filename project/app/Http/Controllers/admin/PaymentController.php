<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\clients\Ordered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        // Xử lý lưu thông tin người mua (tuỳ bạn lưu vào bảng nào)
        $name = $request->name;
        $phone = $request->sdt;
        $address = $request->address . ', ' . $request->xaphuong . ', ' . $request->quanhuyen . ', ' . $request->tinhthanhpho;
        $paymentMethod = $request->thanhtoan;
        $total = $request->totalPrice;

        if ($paymentMethod == 'Thanh toán bằng Momo') {
            // Gửi sang Momo
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMO';
            $accessKey = 'F8BBA842ECF85';
            $secretKey = 'K951B6PE1waDMi640xX08PD3vg6EkVlz';

            $orderId = Str::uuid();
            $orderInfo = "Thanh toán đơn hàng tại Shop";
            $redirectUrl = route('checkout.momoCallback');
            $ipnUrl = route('checkout.momoCallback');
            $extraData = '';

            $requestId = time() . "";
            $requestType = "captureWallet";
            $rawHash = "accessKey=$accessKey&amount=$total&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = [
                'partnerCode' => $partnerCode,
                'partnerName' => "MoMo Payment",
                'storeId' => "Store001",
                'requestId' => $requestId,
                'amount' => $total,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            ];

            $response = Http::post($endpoint, $data);
            if ($response->successful()) {
                $payUrl = $response->json()['payUrl'];

                // Tùy bạn: lưu đơn hàng ở đây nếu cần
                return redirect($payUrl);
            } else {
                return redirect()->back()->with('error', 'Lỗi kết nối tới Momo');
            }
        }

        // Nếu là thanh toán khi nhận hàng
        // Tạo đơn hàng, lưu database
        return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
    }
    public function momoCallback(Request $request)
    {
        if ($request->resultCode == 0) {
            Ordered::create([
                'OrderDate' => now()->format('Y-m-d H:i:s'),
                'Fullname' => session('checkout.name'),
                'Phonenumber' => session('checkout.phone'),
                'Address' => session('checkout.address'),
                'Shippingtype' => 'Thanh toán bằng Momo',
                'Totalprice' => session('checkout.total'),
                'CustomerID' => Auth::check() ? Auth::id() : null,
                'Status' => 'Đã thanh toán',
            ]);


            return redirect()->route('home')->with('success', 'Thanh toán thành công qua Momo!');
        } else {
            return redirect()->route('home')->with('error', 'Thanh toán Momo thất bại hoặc bị huỷ.');
        }
    }
    public function index_list()
    {
        $transactions = MomoTransaction::latest()->paginate(10);
        return view('admin.momo.index', compact('transactions'));
    }
}
