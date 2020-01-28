<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 09/04/2019
 * Time: 15:17
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Collection;
/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="transactions Test API",
 *         description="This is an transactions test api.",
 *         termsOfService="http://swagger.io/terms/",
 *         @OA\Contact(
 *             email="sergyzen@gmail.com"
 *         ),
 *         @OA\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @OA\Server(
 *         description="transactions OpenApi host",
 *         url="#"
 *     ),
 *     @OA\Tag(name="transaction", description="Manage user transactions"),
 * )
 */
class ApiBaseController extends Controller
{
    use Helpers;

    /**
     * Standardize response with data
     * @param array|Collection $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($data)
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }
        return response()->json(array('data' => $data,));
    }
}
