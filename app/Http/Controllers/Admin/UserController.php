<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
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
        try {
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

            try {
                Mail::to($request->email)->send(new WelcomeEmail([
                    'name' => $request->name,
                ]));
            } catch (Throwable $th) {
                Log::debug('Error while sending email.');
            }

            flash()->success('Operation completed successfully.');
            return redirect()->route('admin.users.index');
        } catch (Throwable $th) {
            flash()->error('Operation failed.');
            return redirect()->route('admin.users.index');
        }
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.users.edit', compact('user'));
    }


    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required|numeric',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            flash()->warning('Please check your form and try again.');
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors());
        }

        $user = User::where('id', $id)->first();
        $user->update($request->all());
        flash()->success('Operation completed successfully.');
        return redirect()->route('admin.users.index');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
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
