<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 09/04/2019
 * Time: 15:19
 */

namespace App\Http\Controllers\Api\Auth;


use App\Emuns\HttpErrors;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use App\Response\ApiResponse;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Class LoginController
 * @package App\Http\Controllers\Api\Auth
 */
class LoginController extends ApiBaseController
{
    use SendsPasswordResetEmails;


    protected $guard = 'api';

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api.auth', ['except' => ['login', 'forgotPassword', 'resetPassword']]);
    }

    /**
     * Log user into App
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *   path="/api/auth/login",
     *   summary="Login users",
     *   tags={"auth"},
     *   operationId="login",
     *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     description="required email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string|required",
     *                     description="user password"
     *                 ),
     *                 example={"email": "smarquina", "password": "XXXX"}
     *             )
     *         )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="User and token",
     *     @OA\JsonContent(type="object",
     *       @OA\Items(ref="#/components/schemas/User"),
     *       @OA\Items(title="token", description="Bearer token", type="string"),
     *     ),
     *  ),
     * @OA\Response(response="550", description="User not found / Can't generate user token."),
     * @OA\Response(response="403", description="invalid credentials"),
     * )
     *
     */
    public function login(LoginRequest $request)
    {
        try {
            /** @var User $user */
            $user = User::whereEmail($request->input("email"))->firstOrFail();
            try {
                // attempt to verify the credentials and create a token for the user
                if (!$token = auth()->guard('api')->attempt($request->only(['email', 'password']))) {
                    return ApiResponse::responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, trans('auth.login.invalidCred'));
                } else {

                    //Need once to bypass the resource conversion
                    \Auth::onceUsingId($user->id);

                    // all good so return the token
                    $toReturn = array('token' => $token,
                                      'user'  => new UserResource($user));

                    return response()->json($toReturn);
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                return ApiResponse::responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, trans('auth.login.noToken'));
            } catch (\Exception $exception) {
                \Log::error($exception->getMessage());
                \Log::error($exception);
                return ApiResponse::responseWithError(HttpErrors::HTTP_FORBIDDEN, trans('auth.login.noToken'));
            }
        } catch (\Exception $exception) {
            $msg = config('app.debug') ? $exception->getMessage() : trans('auth.login.userNoExist');
            return ApiResponse::responseWithError(HttpErrors::HTTP_FORBIDDEN, $msg);
        }
    }

    public function getAuthorizationMethod()
    {
        return 'bearer';
    }
}
