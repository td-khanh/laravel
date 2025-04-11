@include('admin.blocks.header')

<h2>Cập nhật danh mục</h2>

<form action="{{ route('category.update', $category->CategoryID) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="CategoryName">Tên danh mục</label>
        <input type="text" name="CategoryName" class="form-control" value="{{ old('CategoryName', $category->CategoryName) }}" required>
    </div>
    <div class="mb-3">
        <label for="Picture">Hình ảnh</label>
        <input type="file" name="Picture" class="form-control">
        @if($category->Picture)
        <img src="{{ asset('assets/admin/img/upload/' . $category->Picture) }}" width="100" class="mt-2">
        @endif
    </div>
    <div class="mb-3">
        <label for="Description">Mô tả</label>
        <textarea name="Description" class="form-control">{{ old('Description', $category->Description) }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
@include('admin.blocks.footer')