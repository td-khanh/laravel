<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Categories;

class CategoryController extends Controller
{
    public function index() {
        $categories = Categories::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(Request $request) {
        $request->validate([
            'CategoryName' => 'required',
            'Description' => 'nullable',
            'Picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120'
        ]);

        $data = $request->only('CategoryName', 'Description');

        if ($request->hasFile('Picture')) {
            $filename = time().'.'.$request->Picture->extension();
            $request->Picture->move(public_path('assets/admin/img/upload'), $filename);
            $data['Picture'] = $filename;
        }

        Categories::create($data);

        return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công');
    }

    public function edit($id) {
        $category = Categories::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $category = Categories::findOrFail($id);
        $data = $request->only('CategoryName', 'Description');

        if ($request->hasFile('Picture')) {
            $filename = time().'.'.$request->Picture->extension();
            $request->Picture->move(public_path('uploads/category'), $filename);
            $data['Picture'] = $filename;
        }

        $category->update($data);
        return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công');
    }

    public function delete($id) {
        Categories::destroy($id);
        return redirect()->route('category.index')->with('success', 'Xoá danh mục thành công');
    }
}
