<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Products;
use App\Models\clients\Categories;

class ProductsController extends Controller
{
    private $getRamDomProduct;
    private $searchProduct;

    public function __construct()
    {
        $this->getRamDomProduct = new Products();
        $this->searchProduct = new Products();
    }

    public function categories() {
        $getAllCategories = Categories::all(); // Hoặc một query khác để lấy danh mục
        return view('clients/products', compact('getAllCategories'));
    }
    
    public function index(Request $request)
    {
        $title = 'Sản phẩm';
        $filters =[];
        $sorting='';
        define('_PER_PAGE', 9);

        if(!empty($request->category))
        {
            $category = $request->category;

            $filters[] = ['product.CategoryID', '=', $category];
            
        }
        

        if(!empty($request->brand))
        {
            $brand = $request->brand;

            $filters[] = ['product.BrandID', '=', $brand];
        }

        if(!empty($request->sorting))
        {
            $sorting = $request->sorting;

        }

        if(!empty($request->amount))
        {
            $amount = $request->amount;
            $arr = explode("-", $amount);
            //Loại bỏ khoảng trắng bên trái và phải của $arr[0] và $arr[1], rồi chuyển sang dạng số nguyên với hàm (int)
            $amount1 = (int)str_replace(".", "", trim($arr[0]));
            $amount2 = (int)str_replace(".", "", trim($arr[1]));
            //Kiểm tra nếu $amount1 bằng 0, gán giá trị $amount1 = 10000 
            if($amount1 == 0){
                $amount1 = 10000;
            }
            $filters[] = ['product.Price', '>=', $amount1];
            $filters[] = ['product.Price', '<=', $amount2];
        }

        $productList = $this->getRamDomProduct->getProduct($filters,$sorting,_PER_PAGE);
        $getAllCategories = Categories::all();
        

        return view('clients/products',compact('title', 'productList', 'getAllCategories'));
    }

    public function search(Request $request)
    {
        $title = 'Sản phẩm';
        $itemSearch = $this->searchProduct->search($request->search);

        // dd($itemSearch);

        return view('clients/products',compact('title', 'itemSearch'));
    }
}
