<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Symfony\Component\HttpFoundation\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:user,email|email',
            'password' => 'required',
            'name' => 'nullable',
        ]);

        $request['created_at'] = date('Y-m-d h:i:sa');
        $request['password'] = Hash::make($request->password);

        $request = $request->all();

        $data = User::create($request);
        return $this->success_cud('Data resep berhasil Diupdate', $data);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'username', 'password']);

        if (!($token = auth()->attempt($credentials))) {
            // return response()->json(['error' => 'Unauthorized'], 401);
            return $this->unauthorized('Unauthorized');
        }

        $cookie = $this->setCookie($token);

        return $this->respondWithToken($token)->withCookie($cookie);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $token = JWTAuth::getToken();
        $apy = JWTAuth::getPayload($token)->toArray();

        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()
                ->factory()
                ->getTTL(),
        ]);
    }

    /**
     * Set cookie details and return cookie
     *
     * @param string $token JWT
     *
     * @return \Illuminate\Cookie\CookieJar|\Symfony\Component\HttpFoundation\Cookie
     */
    private function setCookie($token)
    {
        $min = auth()
            ->factory()
            ->getTTL();

        return new Cookie(env('AUTH_COOKIE_NAME'), $token, strtotime("+{$min} minutes"), null, null, true, true, false, 'Strict');
    }
}
