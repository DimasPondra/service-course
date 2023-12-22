<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only([
                'name', 'slug', 'description', 'type',
                'certificate', 'level', 'status', 'price',
                'thumbnail_file_id', 'mentor_user_id'
            ]);

            dd($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
