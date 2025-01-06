<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\clients\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\clients\Products;

class Productcontroller extends Controller
{
    private $searchProduct;
    public function index()
    {
        $products_list = Products::with('category')->where('status', 1)->paginate(10);
        //dd($products_list);
        return view('admin/products', compact('products_list'));
    }
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $category = Categories::all();
        return view('admin.product.edit', compact('product', 'category'));
    }
    public function create()
    {
        $categories = Categories::all(); // Lấy danh mục sản phẩm
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ProductName' => 'required|string|max:255',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'Price' => 'required|numeric|min:0',
            'Picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $product = new Products();
        $product->ProductName = $request->ProductName;
        $product->CategoryID = $request->CategoryID;
        $product->Price = $request->Price;
        $product->status = $request->status ?? 1;

        if ($request->hasFile('Picture')) {
            $imageName = time() . '_picture.' . $request->Picture->extension();
            $request->Picture->move(public_path('assets/admin/img'), $imageName);
            $product->Picture = $imageName;
        }
    
        if ($request->hasFile('Picture2')) {
            $imageName2 = time() . '_picture2.' . $request->Picture2->extension();
            $request->Picture2->move(public_path('assets/admin/img'), $imageName2);
            $product->Picture2 = $imageName2;
        }

        $product->save();

        return redirect()->route('admin.product')->with('success', 'Sản phẩm mới đã được tạo thành công.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ProductName' => 'required|string|max:255',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'Price' => 'required|numeric|min:0',
            'Picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $product = Products::findOrFail($id);
        $product->ProductName = $request->ProductName;
        $product->CategoryID = $request->CategoryID;
        $product->Price = $request->Price;
        $product->status = $request->status;

        if ($request->hasFile('Picture')) {
            $imageName = time() . '.' . $request->Picture->extension();
            $request->Picture->move(public_path('assets/admin/img'), $imageName);
            $product->Picture = $imageName;
        }
        if ($request->hasFile('Picture2')) {
            $imageName2 = time() . '_picture2.' . $request->Picture2->extension();
            $request->Picture2->move(public_path('assets/admin/img'), $imageName2);
            $product->Picture2 = $imageName2;
        }

        $product->save();

        return redirect()->route('admin.product')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy($id)
    {
        $product = Products::where('ProductID', $id)->firstOrFail();
        $product->status = $product->status = 0;
        $product->save();
        return redirect()->route('admin.product')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $products_list = Products::with('category')
            ->where('ProductName', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('category', function ($query) use ($keyword) {
                $query->where('CategoryName', 'LIKE', '%' . $keyword . '%');
            })
            ->where('status', 1)
            ->paginate(10);


        return view('admin/products', compact('products_list', 'keyword'));
    }
}
