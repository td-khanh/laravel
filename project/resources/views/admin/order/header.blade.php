<style>
  /* Style cho tiêu đề và nút thêm mới */
  .card-header .d-flex h3 {
    margin: 0;
    font-size: 24px;
    font-weight: bold;
  }

  .btn-success {
    background-color: #28a745;
    border-color: #28a745;
    transition: all 0.3s ease;
    color: #fff;
  }

  .btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
  }

  /* Style cho bảng hiển thị sản phẩm */
  .table-head-bg-success {
    border-collapse: collapse;
    width: 100%;
  }

  .table-head-bg-success thead th {
    background-color: #28a745;
    color: white;
    text-align: center;
    padding: 12px;
  }

  .table-head-bg-success tbody tr td {
    text-align: center;
    vertical-align: middle;
    padding: 10px;
  }

  /* Style cho form tìm kiếm */
  form.d-flex {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 20px;
  }

  form.d-flex input {
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 100%;
    border-radius: 25px;
    padding: 12px 20px;
    font-size: 16px;
  }

  form.d-flex input:focus {
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.25);
    border-color: #007bff;
  }

  form.d-flex button {
    transition: background-color 0.3s ease;
    font-weight: bold;
    border-radius: 25px;
    padding: 10px 20px;
    font-size: 16px;
  }

  form.d-flex button:hover {
    background-color: #0056b3;
  }

  /* Style cho hình ảnh sản phẩm trong bảng */
  table img {
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  /* Style cho phần phân trang */
  .pagination {
    justify-content: center;
  }

  .pagination .page-item .page-link {
    border-radius: 25px;
    margin: 0 5px;
    padding: 8px 15px;
    color: #28a745;
    border: 1px solid #28a745;
    transition: all 0.3s ease;
  }

  .pagination .page-item .page-link:hover {
    background-color: #28a745;
    color: #fff;
  }

  svg {
    width: 16px;
    height: 16px;
  }

  /* Style cho trạng thái */
  .status-card {
    border: 1px solid #eaeaea;
    border-radius: 8px;
    text-align: center;
    padding: 20px 10px;
    background-color: #f9f9f9;
    transition: background-color 0.3s ease, border-color 0.3s ease;
  }

  .status-card.active {
    background-color: #ffecec;
    border-color: #ff4d4d;
  }

  .status-card .icon {
    font-size: 24px;
    margin-bottom: 10px;
  }

  .status-card .count {
    font-weight: bold;
    font-size: 20px;
  }

  .status-card .label {
    font-size: 14px;
    color: #555;
  }
</style>
<form action="{{ route('admin.orderd.search') }}" method="GET" class="d-flex align-items-center" style="width: 100%; max-width: 600px;">
  <input
    type="text"
    name="search"
    class="form-control me-3"
    placeholder="Tìm kiếm đơn hàng..."
    value="{{ request()->search }}">
  <button type="submit" class="btn btn-primary">
    <i class="fas fa-search"></i>
  </button>
</form>
<div class="row g-3 mb-4">
  <div class="col-md-2">
    <a href="">
      <div class="status-card ">
        <div class="icon text-primary">
          <i class="fas fa-list-alt"></i>
        </div>
        <div class="count">{{ $total_orders ?? 0 }} đơn</div>
        <div class="label">Tổng số đơn</div>
      </div>
    </a>
  </div>
  <div class="col-md-2">
    <a href="">
      <div class="status-card">
        <div class="icon text-primary">
          <i class="fas fa-clock"></i>
        </div>
        <div class="count">{{ $pending_count ?? 0 }} đơn</div>
        <div class="label">Chờ xác nhận</div>
      </div>
    </a>
  </div>
  <div class="col-md-2">
    <a href="">
      <div class="status-card">
        <div class="icon text-warning">
          <i class="fas fa-truck-loading"></i>
        </div>
        <div class="count">{{ $pickup_count ?? 0 }} đơn</div>
        <div class="label">Chờ lấy hàng</div>
      </div>
    </a>
  </div>
  <div class="col-md-2">
    <a href="">
      <div class="status-card">
        <div class="icon text-info">
          <i class="fas fa-shipping-fast"></i>
        </div>
        <div class="count">{{ $shipping_count ?? 0 }} đơn</div>
        <div class="label">Đang vận chuyển</div>
      </div>
    </a>
  </div>
  <div class="col-md-2">
    <a href="">
      <div class="status-card">
        <div class="icon text-success">
          <i class="fas fa-check-circle"></i>
        </div>
        <div class="count">{{ $delivered_count ?? 0 }} đơn</div>
        <div class="label">Đã giao</div>
      </div>
    </a>
  </div>
  <div class="col-md-2">
    <a href="{{route('admin.orderd.listreturn')}}">
      <div class="status-card">
        <div class="icon text-danger">
          <i class="fas fa-ban"></i>
        </div>
        <div class="count">{{ $cancelled_count ?? 0 }} đơn</div>
        <div class="label">Hủy</div>
      </div>
    </a>
  </div>
</div>