@include('admin.blocks.header')
<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: none;
        font-weight: bold;
        text-align: center;
    }

    input,
    select,
    .form-check-input {
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    input:focus,
    select:focus,
    .form-check-input:focus {
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        border-color: #007bff;
    }

    button:hover {
        background-color: #0056b3 !important;
        transform: scale(1.02);
    }
</style>
<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Chỉnh Sửa Sản Phẩm</h4>
        </div>
        <div class="card-body">
            <!-- Kiểm tra nếu có lỗi -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.product.update', $product->ProductID) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="ProductName" class="form-label fw-bold">Tên Sản Phẩm</label>
                    <input type="text" class="form-control rounded-pill px-3" id="ProductName" name="ProductName" value="{{ old('ProductName', $product->ProductName) }}" required>
                </div>

                <div class="mb-4">
                    <label for="CategoryID" class="form-label fw-bold">Danh Mục</label>
                    <select class="form-select rounded-pill px-3" id="CategoryID" name="CategoryID" required>
                        <option value="">Chọn danh mục</option>
                        @foreach ($category as $category)
                        <option value="{{ $category->CategoryID }}" @if($category->CategoryID == $product->CategoryID) selected @endif>
                            {{ $category->CategoryName }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="BrandID" class="form-label fw-bold">Thương hiệu</label>
                    <select class="form-select rounded-pill px-3" id="BrandID" name="BrandID" required>
                        <option value="">Chọn thương hiệu</option>
                        @foreach ($brandes as $brand)
                        <option value="{{ $brand->BrandID }}" @if($brand->BrandID == $product->BrandID) selected @endif>
                            {{ $brand->BrandName }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="Price" class="form-label fw-bold">Giá</label>
                    <input type="number" class="form-control rounded-pill px-3" id="Price" name="Price" value="{{ old('Price', $product->Price) }}" required>
                </div>
                <div class="mb-4">
                    <label for="Quantity" class="form-label fw-bold">Số lượng</label>
                    <input type="number" class="form-control rounded-pill px-3" id="Quantity" name="Quantity" value="{{ old('Quantity', $product->Quantity) }}" required>
                </div>
                <div class="mb-4">
                    <label for="ProductDesc" class="form-label fw-bold">Mô tả sản phẩm</label>
                    <textarea type="number" class="form-control rounded-pill px-3" id="ProductDesc" name="ProductDesc" value="{{ old('ProductDesc', $product->ProductDesc) }}" required>{{$product->ProductDesc}}</textarea>
                </div>
                <div class="mb-4">
                    <label for="Picture" class="form-label fw-bold">Ảnh Sản Phẩm</label>
                    <input type="file" class="form-control rounded-pill" id="Picture" name="Picture">
                    @if($product->Picture)
                    <div class="mt-3">
                        <img src="{{ asset('assets/admin/img/upload/'.$product->Picture) }}" alt="Product Image" class="rounded shadow" width="150">
                    </div>
                    @endif
                    <input type="file" class="form-control rounded-pill" id="Picture2" name="Picture2">
                    @if($product->Picture2)
                    <div class="mt-3">
                        <img src="{{ asset('assets/admin/img/upload/'.$product->Picture2) }}" alt="Product Image" class="rounded shadow" width="150">
                    </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Trạng Thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="1" id="status1" @if($product->status == 1) checked @endif>
                        <label class="form-check-label" for="status1">Hiển Thị</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="0" id="status0" @if($product->status == 0) checked @endif>
                        <label class="form-check-label" for="status0">Ẩn</label>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary me-2 rounded-pill px-4">Cập Nhật</button>
                    <a href="{{ route('admin.product') }}" class="btn btn-secondary rounded-pill px-4">Hủy</a>
                </div>
            </form>
            
        </div>
    </div>
</div>

@include('admin.blocks.footer')