<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $employee = Employee::all();
            return response()->json([
                'success' => true,
                'data' => $employee
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validasi = Validator::make($request->all(), [
                'nip' => 'required',
                'name' => 'required',
                'nik' => 'required',
                'identity_number' => 'required',
                'user_dept_id' => 'required',
                'company_id' => 'required',
                'user_id' => 'required'
            ]);

            if ($validasi->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ada Kesalahan !',
                    'data' => $validasi->errors()
                ], 422);
            }

            $data=$request->all();
            $employee = Employee::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Data Karyawan berhasil di tambahkan !',
                'data' => $employee
            ], Response::HTTP_CREATED);

        } catch (QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $validasi = Validator::make($request->all(), [
                'nip' => 'required',
                'name' => 'required',
                'nik' => 'required',
                'identity_number' => 'required',
                'user_dept_id' => 'required',
                'company_id' => 'required',
                'user_id' => 'required'
            ]);

            if ($validasi->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ada Kesalahan !',
                    'data' => $validasi->errors()
                ], 422);
            }

            $data=$request->all();
            $employee -> update($data);

            return response()->json([
                'success' => true,
                'message' => 'Data Karyawan berhasil di update !',
                'data' => $employee
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Tidak ada data !',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
