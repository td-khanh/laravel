@include('admin.blocks.header')

@include('admin.order.header')
<div class="card">
  <div class="card-body">
    <form method="GET" action="{{route('admin.orderd')}}" class="mb-3">
      <select name="status" onchange="this.form.submit()" class="form-select w-25 mb-3">
        <option value="">-- Tất cả trạng thái --</option>
        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Chờ xác nhận</option>
        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Chờ lấy hàng</option>
        <option value="3" {{ request('status') == 3 ? 'selected' : '' }}>Đang giao</option>
        <option value="6" {{ request('status') == 6 ? 'selected' : '' }}>Đã giao</option>
        <option value="4" {{ request('status') == 4 ? 'selected' : '' }}>Hủy</option>
        <option value="5" {{ request('status') == 5 ? 'selected' : '' }}>Hoàn</option>
      </select>
    </form>
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
        @foreach($ordered_list as $ordered)
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
            @elseif($ordered -> Status == 6)
            <span style="color: green;">Đã giao</span>
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