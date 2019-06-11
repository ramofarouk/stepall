<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rules\Exists;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (
            Auth::attempt(['email' => request('email_or_telephone'), 'password' => request('password')]) ||
            Auth::attempt(['telephone' => request('email_or_telephone'), 'password' => request('password')])
        ) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $datas = [
                'logged' => 'true',
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'pseudo' => $user->pseudo,
                'email' => $user->email,
                'telephone' => $user->telephone,
                'password' =>  $user->password,
                'code' =>  $user->code,
            ];
            return response()->json(['server_response' => $datas], $this->successStatus);
        } else {
            $datas = [
                'logged' => 'false'
            ];
            return response()->json(['server_response' => $datas], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'pseudo' => 'required',
            'telephone' => 'required',
            'status' => 'required',
            'email' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $code_verif = mt_rand(1000, 9999);
        $input['code'] = $code_verif;
        if (User::where(['email' => $input['email']])->first() || User::where(['telephone' => $input['telephone']])->first()) {
            $datas = [
                'register' => 'false'
            ];
            return response()->json(['server_response' => $datas]);
        } else {
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['first_name'] =  $user->name;
            $datas = [
                'register' => 'true',
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'pseudo' => $user->pseudo,
                'telephone' => $user->telephone,
                'status' => $user->status,
                'email' => $user->email,
                'password' =>  $user->password,
                'code' =>  $user->code,
            ];
            return response()->json(['server_response' => $datas], $this->successStatus);
        }
    }
    /**
     * Update api
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'pseudo' => 'required',
            'telephone' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        if (!User::where(['id' => $input['id_user']])->first()) {
            $datas = [
                'updated' => 'false'
            ];
            return response()->json(['server_response' => $datas]);
        } else {
            User::where(['id' => $input['id_user']])->update([
                'first_name' => $input['first_name'], 'last_name' => $input['last_name'], 'pseudo' => $input['pseudo'],
                'email' => $input['email'], 'telephone' => $input['telephone']
            ]);
            $user = User::where(['id' => $input['id_user']])->first();
            $datas = [
                'updated' => 'true',
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'pseudo' => $user->pseudo,
                'telephone' => $user->telephone,
                'status' => $user->status,
                'email' => $user->email,
                'password' =>  $user->password,
                'code' =>  $user->code,
            ];
            return response()->json(['server_response' => $datas], $this->successStatus);
        }
    }
    /**
     * Change password api
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'old_password' => 'required',
            'n_password' => 'required',
            'cn_password' => 'required|same:n_password'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $user = User::where(['id' => $input['id_user']])->first();
        if (!Hash::check($input['old_password'], $user->password)) {
            $datas = [
                'updated' => 'false'
            ];
            return response()->json(['server_response' => $datas]);
        } else {
            User::where(['id' => $user['id']])->update([
                'password' => bcrypt($input['n_password'])
            ]);
            $user = User::where(['id' => $input['id_user']])->first();
            $datas = [
                'updated' => 'true',
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'pseudo' => $user->pseudo,
                'telephone' => $user->telephone,
                'status' => $user->status,
                'email' => $user->email,
                'password' =>  $user->password,
                'code' =>  $user->code,
            ];
            return response()->json(['server_response' => $datas], $this->successStatus);
        }
    }
    /**
     * Verify code api
     *
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $code = $input['code'];
        $user = User::where(['id' => $input['id']])->first();
        if ($user->code != $code) {
            $datas = [
                'verify' => 'false'
            ];
            return response()->json(['server_response' => $datas]);
        } else {
            User::where(['id' => $user['id']])->update([
                'active' => 1
            ]);
            $user = User::where(['id' => $input['id']])->first();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['first_name'] =  $user->name;
            $datas = [
                'verify' => 'true',
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'pseudo' => $user->pseudo,
                'telephone' => $user->telephone,
                'status' => $user->status,
                'email' => $user->email,
                'password' =>  $user->password,
                'code' =>  $user->code,
                'active' =>  $user->active,
            ];
            return response()->json(['server_response' => $datas], $this->successStatus);
        }
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
