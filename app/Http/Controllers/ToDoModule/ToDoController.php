<?php

namespace App\Http\Controllers\ToDoModule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Models\ToDoModel;


class ToDoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @OA\Get(
     *     tags={"ToDoModule"},
     *     path="/todo",
     *     summary="Get All To Do Data",
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="401", description="Unauthorized"),
     *     @OA\Response(response="403", description="Forbidden"),
     *     @OA\Response(response="404", description="Not Found"), 
     *     @OA\Response(response="500", description="Internal Server Error"), 
     * )
     */
    public function index(){
        $data = ToDoModel::all();
        return response($data);
    }

    /**
     * @OA\Get(
     *     tags={"ToDoModule"},
     *     path="/todo/{id}",
     *     summary="Get To Do Data by ID",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description = "id",
     *          required=true,
     *          @OA\Schema(
     *                 type="string",
     *         )
     *     ),
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="401", description="Unauthorized"),
     *     @OA\Response(response="403", description="Forbidden"),
     *     @OA\Response(response="404", description="Not Found"), 
     *     @OA\Response(response="500", description="Internal Server Error"), 
     * )
     */
    public function show($id){
        $data = ToDoModel::where('id',$id)->get();
        return response ($data);
    }

    /**
     * @OA\Post(
     *     tags={"ToDoModule"},
     *     path="/todo",
     *     summary="Store To Do Data",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"activity","description"},
     *                  @OA\Property(
     *                      property="activity",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      type="string",
     *                  ),
     *              ),
     *          ),
     *      ),
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="401", description="Unauthorized"),
     *     @OA\Response(response="403", description="Forbidden"),
     *     @OA\Response(response="404", description="Not Found"), 
     *     @OA\Response(response="500", description="Internal Server Error"), 
     * )
     */
    public function store (Request $request){
        $data = new ToDoModel();
        $data->id = Uuid::uuid4()->getHex();
        $data->activity = $request->input('activity');
        $data->description = $request->input('description');
        $data->save();

        return response('Data Created');
    }
    
    /**
     * @OA\Put(
     *     tags={"ToDoModule"},
     *     path="/todo/{id}",
     *     operationId="update",
     *     summary="Update To Do Data by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description = "id",
     *          required=true,
     *          @OA\Schema(
     *                 type="string",
     *         )
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  required={"activity","description"},
     *                  @OA\Property(
     *                      property="activity",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      type="string",
     *                  ),
     *              ),
     *          ),
     *      ),
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="401", description="Unauthorized"),
     *     @OA\Response(response="403", description="Forbidden"),
     *     @OA\Response(response="404", description="Not Found"), 
     *     @OA\Response(response="500", description="Internal Server Error"), 
     * )
     */
    public function update(Request $request, $id){
        $data = ToDoModel::where('id',$id)->first();
        $data->activity = $request->input('activity');
        $data->description = $request->input('description');
        $data->save();

        return response('Data Updated');
    }

    /**
     * @OA\Delete(
     *     tags={"ToDoModule"},
     *     path="/todo/{id}",
     *     summary="Delete To Do Data by ID",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description = "id",
     *          required=true,
     *          @OA\Schema(
     *                 type="string",
     *         )
     *     ),
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="401", description="Unauthorized"),
     *     @OA\Response(response="403", description="Forbidden"),
     *     @OA\Response(response="404", description="Not Found"), 
     *     @OA\Response(response="500", description="Internal Server Error"), 
     * )
     */
    public function destroy($id){
        $data = ToDoModel::where('id',$id)->first();
        $data->delete();

        return response('Data Deleted');
    }
}
