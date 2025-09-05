<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $users  = User::latest()->get();

        return $this->success('Users list.', $users);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'age' => 'required|numeric',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {

                $data = [
                    'success' => false,
                    'data' => '',
                    'error' => $validator->errors(),
                    'message' => 'Please check your form and try again.'
                ];
                return response()->json($data, 200);
            }

            $user =  User::create($request->all());

            return $this->sendSuccessOfCreateResponse('Users list.', $user);
        } catch (Throwable $th) {
            $data = [
                'success' => false,
                'data' => '',
                'error' => $th->getMessage(),
                'message' => 'Users list.'
            ];
            return response()->json($data, 200);
        }
    }
}
