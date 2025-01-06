@include('admin.blocks.header')
<style>
  .card-header {
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 15px;
}

form.d-flex {
  display: flex;
  justify-content: flex-start; /* Căn về bên trái */
  align-items: center; /* Căn giữa trên dưới */
}

form.d-flex input {
  transition: all 0.3s ease;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  width: 100%;
}

form.d-flex input:focus {
  box-shadow: 0 4px 10px rgba(0, 123, 255, 0.25);
  border-color: #007bff;
}

form.d-flex button {
  transition: background-color 0.3s ease;
  font-weight: bold;
}

form.d-flex button:hover {
  background-color: #0056b3
}

</style>
<div class="card-header">
  <div class="d-flex align-items-center">
    <form action="{{ route('admin.product.search') }}" method="GET" class="d-flex align-items-center" style="width: 100%; max-width: 600px;">
      <input 
        type="text" 
        name="search" 
        class="form-control me-3" 
        placeholder="Tìm kiếm sản phẩm..." 
        value="{{ request()->search }}" 
        style="border-radius: 25px; padding: 12px 20px; font-size: 16px;"
      >
      <button type="submit" class="btn btn-primary" style="border-radius: 25px; padding: 10px 20px; font-size: 16px;">
        <i class="fas fa-search"></i> 
      </button>
    </form>
  </div>
</div>






<div class="card">
  <div class="card-header">
    <div class="card-title">Danh sách sản phẩm</div>
  </div>
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
          <td>{{ $product -> ProductID }}</td>
          <td>{{ $product->ProductName }}</td>
          <td>{{ $product->category->CategoryName }}</td>
          <td>{{ $product->Price }}</td>
          <td>
            <img src="{{asset('assets/admin/img/upload/'.$product->Picture)}}" alt="Product Image" height="50">
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
    <style>
      svg {
        width: 16px;
        height: 16px;
      }

      /* .page-item svg {
                        width: 12px;
                        
                        height: 12px;
                    } */
    </style>
    <div style="text-align: center; margin-top: 20px;margin-bottom: 20px;">

      {{ $products_list->links() }}

    </div>
    <!-- <table class="table table-head-bg-primary mt-4">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">First</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td colspan="2">Larry the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table> -->
  </div>
</div>
@include('admin.blocks.footer')