<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product List
    function list() {
        $pizzas = Product::select('products.*', 'categories.name as category_name')
            ->when(request('key'), function ($query) {
                $query->where('products.name', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->OrderBy('products.created_at', 'desc')
            ->paginate(3);

        $pizzas->appends(request()->all());

        return view('admin.products.list', compact('pizzas'));
    }
    //product create Page
    public function createPage()
    {

        $categories = Category::select('id', 'name')->get();

        return view('admin.products.create', compact('categories'));

    }

    // product create
    public function create(Request $request)
    {

        $this->productsValidationCheck($request, 'create');
        $data = $this->productsData($request);

        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;
        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess' => 'Product created']);
    }

    // delete
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Product delected']);
    }
    public function edit($id)
    {
        $pizza = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)
            ->first();

        return view('admin.products.edit', compact('pizza'));
    }
    //updatePage

    public function updatePage($id)
    {
        $pizza = Product::where('id', $id)->first();
        $categories = Category::get();
        return view('admin.products.updatePage', compact('pizza', 'categories'));
    }

    public function update(Request $request)
    {

        $this->productsValidationCheck($request, 'update');
        $data = $this->productsData($request);
        if ($request->hasFile('pizzaImage')) {
            $pizzaImage = Product::where('id', $request->pizzaId)->first();
            $pizzaImage = $pizzaImage->image;
            if ($pizzaImage != null) {
                Storage::delete('public/' . $pizzaImage);
            }
            $imgName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $imgName);
            $data['image'] = $imgName;

        }
        Product::where('id', $request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }
    // product validation
    private function productsValidationCheck($request, $action)
    {
        $validationRule = [
            'pizzaName' => 'required|min:3|unique:products,name,' . $request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required',
            'pizzaWaitingTime' => 'required',
            'pizzaPrice' => 'required',
        ];
        $validationRule['pizzaImage'] = $action == 'create' ? ' required|mimes:jpg,png,jpeg,webp' : "mimes:jpg,png,jpeg";
        Validator::make($request->all(), $validationRule, [])->validate();
    }

    // products data
    private function productsData($request)
    {
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'waiting_time' => $request->pizzaWaitingTime,
            'price' => $request->pizzaPrice,

        ];
    }
}
