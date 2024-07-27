<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1');
    }

    public function index() {
        $pageTitle = 'Agents';
        $users = User::where('role', 2)->get();
        return view('admin.user.list', compact('pageTitle', 'users'));
    }

    public function indexAdmin() {
        $pageTitle = 'Admins';
        $admins = User::where('role', 1)->get();
        return view('admin.user.adminList', compact('pageTitle', 'admins'));
    }

    public function create() {
        $pageTitle = 'Add';
        return view('admin.user.add', compact('pageTitle'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required',
            'role' => 'required|in:1,2',
            'password' => 'required|string',
        ]);

        if ($validator->passes()) {
            $email = $request->input('email');
            if (User::where('email', $email)->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email already exists.'
                ]);
            }

            $data = $request->only(['name', 'email', 'phone_number', 'password', 'role']);
            if ($request->role == 1) {
                User::create($data);
                $roleName = 'Admin';
                $redirect = route('admin.user.indexAdmin');
            } else {
                User::create($data);
                $roleName = 'User';
                $redirect = route('admin.user.index');
            }

            return response()->json([
                'status' => true,
                'redirect' => $redirect,
                'message' =>  $roleName.' created successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id) {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Admin not found.');
        }
        if ($user->role == 1) {
            $pageTitle = 'Edit Admin';
            return view('admin.user.edit', compact('user', 'pageTitle'));
        } elseif ($user->role == 2) {
            $pageTitle = 'Edit Agent';
            return view('admin.user.edit', compact('user', 'pageTitle'));
        }
    }


    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string',
            'phone_number' => 'required',
            'password' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input fields',
                'errors' => $validator->errors()
            ]);
        }
        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found.']);
        }

        $email = $request->input('email');

        if (User::where('email', $email)->where('id', '!=', $id)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Email already exists.'
            ]);
        }
        $updateData = $request->only(['name', 'email', 'phone_number', 'role']);
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        if ($user->role == 1) {
            $user->update($updateData);
            return response()->json([
                'status' => true,
                'message' => 'Admin updated successfully.',
                'redirect' => route('admin.user.indexAdmin'),
            ]);
        } elseif ($user->role == 2) {
            $user->update($updateData);
            return response()->json([
                'status' => true,
                'message' => 'User updated successfully.',
                'redirect' => route('admin.user.index'),
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Invalid user type.'], 400);
    }

    public function destroy($id) {
        $currentUserId = auth()->id();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found.']);
        }

        if ($user->role == 1) {
            if ($user->id == $currentUserId) {
                return response()->json([
                    'status' => false,
                    'message' => 'You cannot delete yourself.'
                ]);
            }
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Admin deleted successfully.'
            ]);
        } elseif ($user->role == 2) {
            if ($user->id == $currentUserId) {
                return response()->json([
                    'status' => false,
                    'message' => 'You cannot delete yourself.'
                ]);
            }
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully.'
            ]);
        }
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $admin = auth()->user();
        return view('admin.profile', compact('pageTitle', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $admin = auth()->user();
        $validator = $this->profileValidator($request->only(['name', 'email', 'phone_number', 'image']), $admin->id);
        if ($validator->passes()) {
            if ($request->hasFile('image')) {            
                $old = $admin->image;
                $admin->image = fileUploader($request->image, getFilePath('adminProfilePic'), getFileSize('adminProfilePic'), $old);
            }
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);
            return response()->json([
                'status' => true,
                'redirect' => route('admin.user.profile'),
                'message' => 'Profile Updated Succesfully.'
            ]);
        } else {
            return response()->json([
                'status'=> false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function password()
    {
        $pageTitle = 'Password Setting';
        $admin = auth()->user();
        return view('admin.password', compact('pageTitle', 'admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $validator = Validator::make($request->only('old_password', 'new_password', 'confirm_password'), [
            'old_password' => 'required|min:4',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors() 
            ]);
        }
        $admin = auth()->user();
        if (!Hash::check($request->old_password, $admin->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Your old password is incorrect.'
            ]);
        }
        $admin->password = Hash::make($request->new_password);
        $admin->save();
        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.'
        ]);
    }

    private function profileValidator($data, $id = null)
    {
        $rules = [
            'name' => 'required',
            'email' => [ 'required', 'email', Rule::unique('users')->ignore($id) ],
            'phone_number' => ['nullable', 'string' ],
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ];
        $messages = [
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'email.email' => 'The Email must be a valid Email.',
            'email.unique' => 'The Email already used.',
        ];
        return Validator::make($data, $rules, $messages);
    }

}
