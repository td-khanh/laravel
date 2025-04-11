@include('admin.blocks.header')

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
</style>

<div class="card-header">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Danh sách sản phẩm</h3>
    <a href="{{ route('admin.product.create') }}" class="btn btn-success">
      <i class="fas fa-plus"></i> Thêm mới sản phẩm
    </a>
  </div>
  <form action="{{ route('admin.product.search') }}" method="GET" class="d-flex align-items-center" style="width: 100%; max-width: 600px;">
    <input 
      type="text" 
      name="search" 
      class="form-control me-3" 
      placeholder="Tìm kiếm sản phẩm..." 
      value="{{ request()->search }}">
    <button type="submit" class="btn btn-primary">
      <i class="fas fa-search"></i>
    </button>
  </form>
</div>

<div class="card">
  <div class="card-body">
    <table class="table table-head-bg-success">
      <thead>
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Tên sản phẩm</th>
          <th scope="col">Danh mục</th>
          <th scope="col">Giá</th>
          <th scope="col">Ảnh</th>
          <th scope="col">Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products_list as $product)
        <tr>
          <td>{{ $product->ProductID }}</td>
          <td>{{ $product->ProductName }}</td>
          <td>{{ $product->category->CategoryName }}</td>
          <td>{{ number_format($product->Price, 0, ',', '.') }} VNĐ</td>
          <td>
            <img src="{{ asset('assets/admin/img/upload/' . $product->Picture) }}" alt="Product Image" height="50">
          </td>
          <td>
            <a href="{{ route('admin.product.edit', $product->ProductID) }}" class="btn btn-warning btn-sm" title="Sửa">
              <i class="fas fa-edit"></i> Sửa
            </a>
            <form action="{{ route('admin.product.destroy', $product->ProductID) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">
                <i class="fas fa-trash"></i> Xóa
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
      {{ $products_list->links() }}
    </div>
  </div>
</div>

@include('admin.blocks.footer')
