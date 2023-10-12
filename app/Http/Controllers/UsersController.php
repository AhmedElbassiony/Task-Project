<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index()
    {
        return view('dashboard.users.index');
    }

    public function data()
    {
        $users = User::query()->role('user')->with('products');
        return DataTables::of($users)
            ->addColumn('actions', 'dashboard.users.data_table.actions')
            ->addColumn('link', 'dashboard.users.data_table.link')
            ->addColumn('status', 'dashboard.users.data_table.status')
            ->rawColumns(['actions', 'status', 'link'])
            ->toJson();
    }

    public function create()
    {
        $products = Product::query()->orderBy('name')->get();
        return view('dashboard.users.create', compact('products'));
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

        try {
            DB::transaction(function () use ($data, $request) {
                $user = User::create($data);
                $user->assignRole('user');
                if (isset($request->products)) {
                    $user->products()->attach($request->products);
                }
            });
        } catch (\Exception $e) {
            session()->flash('error', "حدث خطأ عند اضافة مستخدم");
            return redirect()->route('users.index');
        }

        session()->flash('success', 'تم إضافة مستخدم جديد بنجاح');
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $products = Product::query()->orderBy('name')->get();
        return view('dashboard.users.edit', compact('user', 'products'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|digits:11|unique:users,mobile,' . $user->id,
            'password' => 'nullable|min:6',
            'verified' => 'required|boolean',
        ]);
        try {
            DB::transaction(function () use ($data, $request, $user) {
                $user->update([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'mobile' => $data['mobile'],
                    'verified' => $data['verified'],
                ]);
                if ($request->filled('password')) {
                    $user->update([
                        'password' => Hash::make($data['password']),
                    ]);
                }
                $user->products()->sync($request->products);
            });
        } catch (\Exception $e) {
            session()->flash('error', "حدث خطأ عند تعديل مستخدم");
            return redirect()->route('users.index');
        }


        session()->flash('success', 'تم تعديل مستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'تم حذف مستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function showUserProducts($id)
    {
        $user = User::with('products')->findOrFail($id);
        return view('dashboard.users.products.index', compact('user'));
    }
}
