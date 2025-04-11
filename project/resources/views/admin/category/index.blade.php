@include('admin.blocks.header')

<h2>Danh sách danh mục</h2>
<a href="{{ route('category.create') }}" class="btn btn-success mb-2">Thêm mới</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Hình</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $cat)
        <tr>
            <td>{{ $cat->CategoryID }}</td>
            <td>{{ $cat->CategoryName }}</td>
            <td>
                @if($cat->Picture)
                    <img src="{{ asset('assets/admin/img/upload/'.$cat->Picture) }}" width="60">
                @endif
            </td>
            <td>{{ $cat->Description }}</td>
            <td>
                <a href="{{ route('category.edit', $cat->CategoryID) }}" class="btn btn-warning btn-sm">Sửa</a>
                <a href="{{ route('category.delete', $cat->CategoryID) }}" class="btn btn-danger btn-sm" onclick="return confirm('Xoá?')">Xoá</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@include('admin.blocks.footer')