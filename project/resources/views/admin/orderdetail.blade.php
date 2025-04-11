@include('admin.blocks.header')
@include('admin.order.header')

<style>
    .invoice {
        max-width: 700px;
        margin: 50px auto;
        padding: 20px;
    }
</style>

<div class="container my-5">
    <div class="invoice p-4 border rounded shadow-sm">

        <!-- Tiêu đề -->
        <div class="text-center mb-4">
            <h2>Phiếu Hàng</h2>
            <p><strong>Mã đơn hàng:</strong> {{ $order->OrderID }}</p>
            <p><strong>Ngày:</strong> {{ $order->OrderDate }}</p>
        </div>

        <!-- Thông tin người gửi và nhận -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Thông tin người gửi</h5>
                <p><strong>Họ và tên:</strong> Thời Trang Duy Khánh</p>
                <p><strong>Địa chỉ:</strong> 89 Phạm Văn Đồng</p>
                <p><strong>Điện thoại:</strong> 0987654321</p>
            </div>
            <div class="col-md-6">
                <h5>Thông tin người nhận</h5>
                <p><strong>Họ tên:</strong> {{ $order->Fulname }}</p>
                <p><strong>Điện thoại:</strong> {{ $order->Phonenumber }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->Address }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->Totalprice, 0, ',', '.') }} VNĐ</p>
            </div>
        </div>

        <!-- Bảng sản phẩm -->
        <h5>Chi tiết sản phẩm</h5>
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderdetails as $detail)
                <tr>
                    <td>{{ $detail->product->ProductName }}</td>
                    <td>{{ $detail->QuantityOrdered }}</td>
                    <td>{{ number_format($detail->Price, 0, ',', '.') }} VNĐ</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tổng kết -->
        <div class="text-end">
            <p><strong>Tổng cộng: </strong>{{ number_format($order->Totalprice, 0, ',', '.') }} VNĐ</p>
            <p><strong>Thanh toán: </strong><span class="text-danger">{{ $order->Shippingtype }}</span></p>
        </div>

        <!-- Form cập nhật trạng thái -->
        <form action="{{ route('admin.updateStatus', $order->OrderID) }}" method="PUT">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="status">Trạng thái đơn hàng:</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ $order->Status == 1 ? 'selected' : '' }}>Chờ xác nhận</option>
                    <option value="2" {{ $order->Status == 2 ? 'selected' : '' }}>Chờ lấy hàng</option>
                    <option value="3" {{ $order->Status == 3 ? 'selected' : '' }}>Đang giao</option>
                    <option value="6" {{ $order->Status == 6 ? 'selected' : '' }}>Đã giao</option>
                    <option value="4" {{ $order->Status == 4 ? 'selected' : '' }}>Đã hủy</option>
                    <option value="5" {{ $order->Status == 5 ? 'selected' : '' }}>Đã hoàn</option>
                </select>
            </div>

            @if(in_array($order->Status, [4, 6]))
            <div class="alert alert-danger mt-3">
                <strong>Thông báo:</strong> Trạng thái đơn hàng đã không thể thay đổi (Đã giao hoặc Đã hủy).
            </div>
            @else
            <button type="submit" class="btn btn-primary mt-3">Cập nhật trạng thái</button>
            @endif
        </form>

    </div>
</div>

@include('admin.blocks.footer')