@include('admin.blocks.header')

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Tạo Mới Sản Phẩm</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="ProductName" class="form-label fw-bold">Tên Sản Phẩm</label>
                    <input type="text" class="form-control rounded-pill px-3" id="ProductName" name="ProductName" value="{{ old('ProductName') }}" required>
                </div>

                <div class="mb-4">
                    <label for="CategoryID" class="form-label fw-bold">Danh Mục</label>
                    <select class="form-select rounded-pill px-3" id="CategoryID" name="CategoryID" required>
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->CategoryID }}">{{ $category->CategoryName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="CategoryID" class="form-label fw-bold">Thương hiệu</label>
                    <select class="form-select rounded-pill px-3" id="BrandID" name="BrandID" required>
                        <option value="">Chọn thương hiệu</option>
                        @foreach ($brandes as $brand)
                        <option value="{{ $brand->BrandID }}">{{ $brand->BrandName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="Price" class="form-label fw-bold">Giá</label>
                    <input type="number" class="form-control rounded-pill px-3" id="Price" name="Price" value="" required>
                </div>
                <div class="mb-4">
                    <label for="Quantity" class="form-label fw-bold">Số lượng</label>
                    <input type="number" class="form-control rounded-pill px-3" id="Quantity" name="Quantity" value="" required>
                </div>
                <div class="mb-4">
                    <label for="ProductDesc" class="form-label fw-bold">Mô tả sản phẩm</label>
                    <textarea type="number" class="form-control rounded-pill px-3" id="ProductDesc" name="ProductDesc" value="" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="Picture" class="form-label fw-bold">Ảnh Sản Phẩm</label>
                    <div class="mb-4">
                        <label for="Picture" class="form-label fw-bold">Ảnh 1</label>
                        <input type="file" class="form-control rounded-pill" id="Picture" name="Picture">
                    </div>

                    <div class="mb-4">
                        <label for="Picture2" class="form-label fw-bold">Ảnh 2</label>
                        <input type="file" class="form-control rounded-pill" id="Picture2" name="Picture2">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Trạng Thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="1" id="status1" checked>
                        <label class="form-check-label" for="status1">Hiển Thị</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="0" id="status0">
                        <label class="form-check-label" for="status0">Ẩn</label>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success me-2 rounded-pill px-4">Tạo Mới</button>
                    <a href="{{ route('admin.product') }}" class="btn btn-secondary rounded-pill px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.blocks.footer')