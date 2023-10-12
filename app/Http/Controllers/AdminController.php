<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Datatables\AdminProfileResource;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admins.index');
    }

    public function data()
    {
        return datatables(AdminProfileResource::collection(User::role('admin')->latest()->get()))
            ->addColumn('actions', 'dashboard.admins.data_table.actions')
            ->addColumn('link', 'dashboard.admins.data_table.link')
            ->rawColumns(['actions', 'link'])
            ->toJson();
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|digits:11|unique:users,mobile',
            'password' => 'required|min:6',

        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'verified' =>true,
        ]);
        $user->assignRole('admin');

        session()->flash('success', 'تم إضافة مسئول جديد بنجاح');
        return redirect()->route('admins.index');
    }



    public function edit(User $admin)
    {
        return view('dashboard.admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'mobile' => 'required|digits:11|unique:users,mobile,' . $admin->id,
            'password' => 'nullable|min:6',

        ]);

        $admin->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
        ]);
        if ($request->filled('password')) {
            $admin->update([
                'password' => Hash::make($data['password']),
            ]);
        }

        session()->flash('success', 'تم تعديل مسئول بنجاح');
        return redirect()->route('admins.index');
    }

    public function destroy(User $admin)
    {
        $admin->delete();
        session()->flash('success', 'تم حذف مسئول بنجاح');
        return redirect()->route('admins.index');
    }
}
