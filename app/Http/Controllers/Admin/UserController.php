<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            flash()->warning('Please check your form and try again.');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors());
        }

        User::create($request->all());
        flash()->success('Operation completed successfully.');
        return redirect()->route('admin.users.index');
    }








































    // public function store(Request $request)
    // {
    //     // $validator = Validator::make($request->all(), [
    //     //     'name' => 'required|max:55',
    //     //     'release_date' => 'date',
    //     //     'language' => 'max:15',
    //     //     'genre_id' => 'required|exists:genres,id',
    //     // ]);

    //     // if ($validator->fails()) {
    //     //     toastr()->warning('Please check your form and try again.');
    //     //     return redirect()->back()
    //     //         ->withInput($request->input())
    //     //         ->withErrors($validator->errors());
    //     // }


    //     User::create($request->all());

    //     toastr()->success('Data has been created successfully!');
    //     return redirect()->route('admin.movies.index');
    // }
}
