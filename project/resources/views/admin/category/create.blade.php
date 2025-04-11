@include('admin.blocks.header')

<form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
    
    @csrf
    <div class="mb-3">
        <label for="CategoryName">Tên danh mục</label>
        <input type="text" name="CategoryName" class="form-control" value="" required>
    </div>
    <div class="mb-3">
        <label for="Picture">Hình ảnh</label>
        <input type="file" name="Picture" class="form-control">
    </div>
    <div class="mb-3">
        <label for="Description">Mô tả</label>
        <textarea name="Description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Lưu</button>

</form>

@include('admin.blocks.footer')