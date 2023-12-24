<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseImageStoreRequest;
use App\Models\CourseImage;
use App\Repositories\CourseImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseImageController extends Controller
{
    private $courseImageRepository;

    public function __construct(CourseImageRepository $courseImageRepository)
    {
        $this->courseImageRepository = $courseImageRepository;
    }

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
    public function store(CourseImageStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only(['file_id', 'course_id']);

            $courseImage = new CourseImage();
            $this->courseImageRepository->save($courseImage->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, ' . $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Course image successfully created.'
        ], 201);
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
    public function destroy(CourseImage $courseImage)
    {
        try {
            DB::beginTransaction();

            $courseImage->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, ' . $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Course image successfully deleted.'
        ], 200);
    }
}
