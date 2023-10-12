<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserDetailsResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        return api_response(true, '', new UserDetailsResource(auth()->user()));
    }


    public function update(Request $request)
    {

        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'mobile' => 'required|digits:11|unique:users,mobile,' . auth()->id(),

        ]);

        auth()->user()->update($data);

        return api_response(true, 'updated successfully', new UserDetailsResource(auth()->user()));
    }

    public function destroy(User $student)
    {
        $student->forceDelete();

        return api_response(true, 'account deleted successfully');
    }

    public function myProducts()
    {
        return api_response(true, '', ProductResource::collection(auth()->user()->products()->paginate()));
    }

    // public function showUserProducts(User $user)
    // {
    //     return api_response(true, '', new ProductResource($user->products()->paginate()));
    // }

    public function UserAssignProduct(Request $request)
    {

        $data =  $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
        ]);
        try {
            $data_transactions = DB::transaction(function () use ($data) {
                $user = User::find($data['user_id']);
                $user->products()->attach($data['product_id']);
                return $user->products()->paginate();
            });
        } catch (\Exception $e) {
            return api_response(false, 'connection error', null, 400);
        }

        return api_response(true, 'Product assigned successfully', ProductResource::collection($data_transactions));
    }
}
