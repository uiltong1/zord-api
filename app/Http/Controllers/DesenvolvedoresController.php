<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\DesenvolvedorInterface;
use App\Http\Requests\DesenvolvedorResquest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DesenvolvedoresController extends Controller
{
    private $_desenvolvedor;

    public function __construct(DesenvolvedorInterface $_desenvolvedor)
    {
        $this->_desenvolvedor = $_desenvolvedor;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            return response()->json($this->_desenvolvedor->index($request), Response::HTTP_OK);
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
    public function store(DesenvolvedorResquest $request)
    {
        try {
            return response()->json($this->_desenvolvedor->store($request), Response::HTTP_OK);
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
            return response()->json($this->_desenvolvedor->show($id), Response::HTTP_OK);
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
    public function update(Request $request, $id)
    {
        try {
            return response()->json($this->_desenvolvedor->update($request, $id), Response::HTTP_OK);
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
            $this->_desenvolvedor->destroy($id);
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
