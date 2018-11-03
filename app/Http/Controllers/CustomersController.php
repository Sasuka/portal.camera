<?php

namespace App\Http\Controllers;

use App\Customers;
use App\Helpers\Common as ResponseFormat;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CustomersController extends Controller
{
    protected $user = null;
    private $err = 'errors';
    private $suc = 'success';

    /*
     * params: email & password
     * receive: token
     * */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json(ResponseFormat::formatData(403, $validator->errors()));
            }
            $credentials = $request->only('email', 'password');
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(ResponseFormat::formatData(403, 'Invalid credentials'));
            }
            return response()->json(ResponseFormat::formatData(200, 'Success', $token));
        } catch (JWTException $exception) {
            return response()->json(ResponseFormat::formatData(500, 'Failed'));
        }
    }

    /*
     * Register A user
     * @params name String
     * @params email Email
     * @param password Password bcryt
     * */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|max:20',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = Customers::create([
            'customer_guid' => 'f1eea2f7-fd89-4fb3-9624-c81a81ca44' . random_int(10, 99),
            'email' => $request->email,
            'user_name' => $request->user_name,
            'password' => bcrypt($request->password),
            'password_format_id' => 2,
            'password_salt' => 'yHt/eoE=',
            'full_name' => $request->full_name,
            'address' => '123 ABC',
            'card_id' => '123123123',
            'mobile_phone' => $request->mobile_phone,
            'is_system_account' => 1,
            'limit_login' => 1,
            'email_warning' => $request->email,
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 201);
    }

    /*
         * Register A user
         * @params name String
         * @params email Email
         * @param password Password bcryt
         * */

    public function registerUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|max:20',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::create([
            'customer_guid' => 'f1eea2f7-fd89-4fb3-9624-c81a81ca44' . random_int(10, 99),
            'email' => $request->email,
            'user_name' => $request->user_name,
            'password' => bcrypt($request->password),
            'password_format_id' => 2,
            'password_salt' => 'yHt/eoE=',
            'full_name' => $request->full_name,
            'address' => '123 ABC',
            'card_id' => '123123123',
            'mobile_phone' => $request->mobile_phone,
            'is_system_account' => 1,
            'limit_login' => 1,
            'email_warning' => $request->email,
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 201);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customers $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customers $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Customers $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customers $customers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customers $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customers)
    {
        //
    }
}
