<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() 
    {
        $pageTitle = 'Agents';
        $users = User::where('role', 2)->orderBy('created_at', 'desc')->paginate(7);
        return view('admin.user.list', compact('pageTitle', 'users'));
    }

    public function indexAdmin() 
    {
        $pageTitle = 'Admins';
        $admins = User::where('role', 1)->orderBy('created_at', 'desc')->paginate(7);
        return view('admin.user.adminList', compact('pageTitle', 'admins'));
    }

    public function create() 
    {
        $pageTitle = 'Add';
        return view('admin.user.add', compact('pageTitle'));
    }

    public function store(Request $request) 
    {
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
            $data = $request->only(['name', 'agency_name', 'email', 'phone_number', 'password', 'role']);
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

    public function edit($id) 
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Admin not found.');
        }
        if ($user->role == 1) {
            $pageTitle = 'Edit Admin';
            $type = '';
            return view('admin.user.edit', compact('user', 'pageTitle', 'type'));
        } elseif ($user->role == 2) {
            $pageTitle = 'Edit Agent';
            $type = 'Agnet';
            return view('admin.user.edit', compact('user', 'pageTitle', 'type'));
        }
    }

    public function update(Request $request, $id) 
    {
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
        $updateData = $request->only(['name', 'agency_name', 'email', 'phone_number', 'role']);
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

    public function destroy($id) 
    {
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
}
