<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    //
    protected $user = null;
    private $err = 'errors';
    private $suc = 'success';

    public function __construct()
    {
        $this->middleware('permission:user.edit')->only('getShowAll');
    }

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
                return response()->json(['status' => $this->err, 'mess' => $validator->errors()], 401);
            }
            $credentials = $request->only('email', 'password');
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['status' => $this->err, 'mess' => 'Invalid credentials'], 400);
            }
            return response()->json(['status' => $this->suc, 'mess' => $token], 200);
        } catch (JWTException $exception) {
            return response()->json(['mess' => $exception], 500);
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 201);
    }

    /*
     * @params request: email and password
     * @params reponse: token
     * */

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|max:255',
                'password' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => $this->err, 'mess' => $validator->errors()], 401);
            }
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    /*
     * Create Role
     * @params name : required
     * @params display_name : required
     * @params description : allow null
     * */
    public function createRole(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'display_name' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => $this->err, 'mess' => $validator->errors()], 401);
            }
            $role = Role::where('name', '=', $request->input('name'))->first();
            if ($role)
                return response()->json(['status' => $this->err, 'mess' => 'Role is exists'], 401);
            $role = new Role();
            $role->fill($request->all());
            $role->save();
            return response()->json("created");
        } catch (JWTException $exception) {
            return response()->json(['mess' => $exception], 500);
        }
    }

    /*
     * Permission
     * @params name : required
     * @params display_name : required
     * @params description : allow null
     * */
    public function createPermission(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'display_name' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => $this->err, 'mess' => $validator->errors()], 401);
            }
            $permission = Permission::where('name', '=', $request->input('name'))->first();
            if ($permission)
                return response()->json(['status' => $this->err, 'mess' => 'Permission is exists'], 401);
            $permission = new Permission();
            $permission->fill($request->all());
            $permission->save();
            return response()->json("created");
        } catch (JWTException $exception) {
            return response()->json(['mess' => $exception], 500);
        }
    }

    /*
     * Assign Role
     * email : mail of User
     * name : name of Role
     * */
    public function assignRole(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'role' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => $this->err, 'mess' => $validator->errors()], 401);
            }
            $user = User::where('email', '=', $request->input('email'))->first();
            $role = Role::where('name', '=', $request->input('role'))->first();
            if (!$role || !$user) {
                $mess = 'Not found';
                if (!$role)
                    $mess .= ' role';
                if (!$user)
                    $mess .= ' user';
                return response()->json(['status' => $this->err, 'mess' => $mess], 401);
            }
            if ($user->hasRole($role->name))
                return response()->json(['status' => $this->err, 'mess' => 'This is exists'], 400);

            $user->attachRole($role);

            return response()->json("created");
        } catch (JWTException $exception) {
            return response()->json(['mess' => $exception], 500);
        }
    }

    /*
     * attachPermission
     * name: name of Permission
     * role: name of Role
     * */
    public function attachPermission(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'role' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => $this->err, 'mess' => $validator->errors()], 401);
            }
            $permission = Permission::where('name', '=', $request->input('name'))->first();
            $role = Role::where('name', '=', $request->input('role'))->first();
            if (!$role || !$permission) {
                $mess = 'Not found';
                if (!$role)
                    $mess .= ' role';
                if (!$permission)
                    $mess .= ' permission';
                return response()->json(['status' => $this->err, 'mess' => $mess], 401);
            }
            if ($role->hasPermission($permission->name))
                return response()->json(['status' => $this->err, 'mess' => 'This is exists'], 400);

            $role->attachPermission($permission);

            return response()->json("created");
        } catch (JWTException $exception) {
            return response()->json(['mess' => $exception], 500);
        }
    }

    public function getShowAll(Request $request){
        return 'This action is show all';
    }

}
