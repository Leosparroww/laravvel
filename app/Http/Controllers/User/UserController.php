<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        $pizza = Product::get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $categoryId = null;
        return view('user.main.home', compact('pizza', 'category', 'cart', 'categoryId'));
    }

    // filter pizza
    public function filter($pizzaId)
    {
        $pizza = Product::where('category_id', $pizzaId)->OrderBy('created_at', 'desc')->get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $category = Category::get();
        $categoryId = $pizzaId;

        return view('user.main.home', compact('pizza', 'category', 'cart', 'categoryId'));
    }

    // order history

    public function history()
    {
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate('6');

        return view('user.main.history', compact('order'));
    }
    //pizza details
    public function pizzaDetails($pizzaId)
    {
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('pizza', 'pizzaList'));
    }
    //cart list

    public function cartList()
    {
        $cart = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as pizza_image')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('user_id', Auth::user()->id)
            ->get();
        $totalPrice = 0;
        foreach ($cart as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }

        return view('user.cart.cart', compact('cart', 'totalPrice'));
    }
    //details account page
    public function accountChangePage()
    {
        return view('user.account.details');
    }
    public function accountChange($id, Request $request)
    {
        // dd($id, $request->toArray());
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        if ($request->hasFile('image')) {

            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $imageName);
            $data['image'] = $imageName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('user#accountChangePage')->with(['updateSuccess' => 'Profile Updated']);

    }
    //password change page
    public function passwordChangePage()
    {
        return view('user.account.changePassword');
    }

    //password change
    public function passwordChange(Request $request)
    {
        $this->passwordChangeValidationCheck($request);

        $user = User::where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;
        if (Hash::check($request->oldPassword, $dbHashValue)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword),
            ]);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return back()->with(['changeSuccess' => 'Password changed']);
        }
        return back()->with(['notMatch' => 'old password does wrong, try again...']);

    }
    // users list

    public function userList()
    {
        $user = User::where('role', 'user')->paginate('10');
        return view('admin.users.userLists', compact('user'));
    }

    // user change role
    public function userRoleChange(Request $request)
    {

        User::where('id', $request->userId)->update(['role' => $request->role]);
        return response()->json(['status => success'], 200);
    }

    // user update

    public function userEdit($id)
    {
        $user = User::where('id', $id)->first();

        return view('admin.users.userEdit', compact('user'));
    }

    // user update
    public function userUpdate(Request $request)
    {

        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        if ($request->hasFile('image')) {

            $dbImage = User::where('id', $request->userId)->first();
            $dbImage = $dbImage->image;
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $imageName);
            $data['image'] = $imageName;
        }
        User::where('id', $request->userId)->update($data);
        return redirect()->route('user#list')->with(['updateSuccess' => 'account updated']);
    }

    // user contact us

    public function contactUser()
    {

        return view('user.contact.contact');
    }

    public function userMessageSent(Request $request)
    {
        $this->userMessageValition($request);
        $data = $this->userMessageData($request);
        Contact::where('id', Auth::user()->id)->create($data);
        return back()->with(['messageSent' => 'Message sent']);
    }

    // user Message list on admin

    public function userMessageList()
    {
        $messages = Contact::when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('message', 'like', '%' . request('key') . '%')
                ->orWhere('subject', 'like', '%' . request('key') . '%')
                ->orWhere('id', 'like', '%' . request('key') . '%');
        })
            ->paginate('10');
        $messages->appends(request()->all());

        return view('admin.users.userMessages', compact('messages'));
    }
    //message clear

    public function messageClear(Request $request)
    {
        contact::where('id', $request->id)->delete();
        return response()->json(['status => delete success']);
    }

    // message info

    public function messageInfo($id)
    {
        $message = Contact::where('id', $id)->first();
        return view('admin.users.userMessageInfo', compact('message'));
    }
    // user message validation  & data
    private function userMessageValition($request)
    {
        Validator::make($request->all(), [
            'userName' => 'required',
            'userEmail' => 'required',
            'userSubject' => 'required:min:3',
            'userMessage' => 'required|min:5',
        ])->validate();
    }

    private function userMessageData($request)
    {
        return [
            'user_id' => Auth::user()->id,
            'name' => $request->userName,
            'email' => $request->userEmail,
            'subject' => $request->userSubject,
            'message' => $request->userMessage,

        ];
    }

    //password validation
    private function passwordChangeValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6|same:newPassword',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ], [

        ])->validate();
    }
    //account validation
    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,png,jpeg',

        ])->validate();

    }

    //userdata

    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }

}