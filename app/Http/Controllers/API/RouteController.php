<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{

    // userList

    public function userList()
    {

        $userList = User::get();

        return response()->json($userList, 200);
    }

    //product list

    public function productList()
    {

        $productList = Product::get();

        return response()->json($productList, 200);
    }
    //category list
    public function categoryList()
    {

        $categoryList = Category::get();

        return response()->json($categoryList, 200);
    }
    //create category
    public function createCategory(Request $request)
    {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Category::create($data);
        $contact = Category::Orderby('created_at', 'desc')->get();
        return response()->json($contact, 200);
    }
// contact create
    public function createContact(Request $request)
    {
        $data = $this->contactData($request);
        $response = Contact::create($data);
        return response()->json($response, 200);

    }

    //category delete

    public function deleteCategory(Request $request)
    {
        $data = Category::where('id', $request->id)->first();

        if (isset($data)) {
            Category::where('id', $request->id)->delete();
            return response()->json(['status' => true, 'message' => 'deletesuccess', 'DeleteData' => $data], 200);

        }
        return response()->json(['status' => false, 'message' => 'There is no category'], 200);

    }
    // category details

    public function categoryDetails($id)
    {
        $data = Category::where('id', $id)->first();
        if (isset($data)) {
            return $data;
        }
        return response()->json(['message' => 'there is no data']);
    }

    //category update

    public function categoryUpdate(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();
        $categoryData = $this->categoryData($request);

        if (isset($data)) {
            Category::where('id', $request->category_id)->update($categoryData);
            $updatedData = Category::where('id', $request->category_id)->first();

            return response()->json(['status' => true, 'message' => 'update success', 'before updated' => $data, 'updated data' => $updatedData], 200);
        }

        return response()->json(['status' => false, 'message' => 'there is no category for update ....'], 500);
    }

    //category data

    private function categoryData($request)
    {
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ];
    }

    //contact data
    private function contactData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

    }
}
