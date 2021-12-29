<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\NivelInterface;
use App\Http\Requests\NivelRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NiveisController extends Controller
{

    private $_nivel;

    public function __construct(NivelInterface $_nivel)
    {
        $this->_nivel = $_nivel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            return response()->json($this->_nivel->index($request), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], $e->getCode() ?? Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NivelRequest $request)
    {
        try {
            return response()->json($this->_nivel->store($request), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], $e->getCode() ?? Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json($this->_nivel->show($id), Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], $e->getCode() ?? Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NivelRequest $request, $id)
    {
        try {
            return response()->json($this->_nivel->update($request, $id), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], $e->getCode() ?? Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->_nivel->destroy($id);
            return response()->noContent(Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], $e->getCode() ?? Response::HTTP_BAD_REQUEST);
        }
    }
}
