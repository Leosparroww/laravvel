<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    //password change  Page
    public function passwordChangePage()
    {

        return view('admin.account.changePassword');
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
// direct admin detailspage
    public function details()
    {
        return view('admin.account.details');
    }
    //acc editpage
    public function edit()
    {
        return view('admin.account.edit');
    }
    public function update($id, Request $request)
    {
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
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Profile Updated']);

    }

    //admin list
    function list() {
        $admin = User::when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%')
                ->orWhere('gender', 'like', '%' . request('key') . '%')
                ->orWhere('phone', 'like', '%' . request('key') . '%');
        })->where('role', 'admin')
            ->paginate(5);
        $admin->appends(request()->all());

        return view('admin.account.list', compact('admin'));
    }

    //change role page

    public function changeRole($id)
    {
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }
    // chaning role
    public function change($id, Request $request)
    {
        $data = $this->requestUserData($request);
        User::where('id', $id)->update($data);
        return redirect()->route('admin#list');

    }
    //acc delete
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'account Deleted']);
    }

    // request user data
    private function requestUserData($request)
    {
        return [
            'role' => $request->role,
        ];
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

    // password cahnge validation

    private function passwordChangeValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6|same:newPassword',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ], [

        ])->validate();
    }

}
