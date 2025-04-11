@include('admin.blocks.header')
@include('admin.order.header')
<div class="card">
    <div class="card-body">
        <table class="table table-head-bg-success">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Ngày đặt</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cancelled as $ordered)
                <tr>
                    <td>{{ $ordered->OrderID }}</td>
                    <td>{{ $ordered->Fulname }}</td>
                    <td>{{ $ordered->OrderDate }}</td>
                    <td>{{ number_format($ordered->Totalprice, 0, ',', '.') }} VNĐ</td>
                    <td>
                        @if($ordered -> Status == 1)
                        <span style="color: blue;">Chờ xác nhận</span>
                        @elseif($ordered -> Status == 2)
                        <span style="color: orange;">Chờ lấy hàng</span>
                        @elseif($ordered -> Status == 3)
                        <span style="color: green;">Đang giao</span>
                        @elseif($ordered -> Status == 4)
                        <span style="color: red;">Hủy</span>
                        @elseif($ordered -> Status == 5)
                        <span style="color: purple;">Hoàn</span>
                        @else
                        <span style="color: gray;">Không xác định</span>
                        @endif

                    </td>
                    <td>
                        <a href="{{route('admin.orderdetail', $ordered->OrderID) }}" class="btn btn-warning btn-sm" title="Sửa">
                            <i class="fas fa-edit"></i> Chi tiết
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>
@include('admin.blocks.footer')