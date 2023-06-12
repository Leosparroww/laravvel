<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category list
    function list() {

        $categories = Category::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })
            ->OrderBy('created_at', 'desc')
            ->paginate(5);

        $categories->appends(request()->all());
        return view('admin.category.list', compact('categories'));
    }
    //direct category page
    public function createPage()
    {
        return view('admin.category.categoryCreate');
    }
    //create category
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess' => 'Category Created']);
    }
    //edit page
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();

        return view('admin.category.edit', compact('category'));
    }
    //update
    public function update(Request $request)
    {

        $this->categoryValidationCheck($request);

        $data = $this->requestCategoryData($request);
        Category::where('id', $request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess' => 'Category Update']);
    }
    //delete page
    public function delete($id)
    {

        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Category Deleted']);
    }

    //request validation check
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [

            'categoryName' => 'required|min:4|unique:categories,name,' . $request->categoryId,
        ])->validate();
    }
    //categoryData
    private function requestCategoryData($request)
    {
        return [

            'name' => $request->categoryName,

        ];
    }
}
