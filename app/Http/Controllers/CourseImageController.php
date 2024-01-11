<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseImageStoreRequest;
use App\Http\Resources\CourseImageResource;
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

            $check = CourseImage::where('file_id', $request->file_id)
                                ->where('course_id', $request->course_id)
                                ->first();

            if ($check) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Data is duplicated and can't be processed."
                ], 400);
            }

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
    public function show(CourseImage $courseImage)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully get data.',
            'data' => new CourseImageResource($courseImage)
        ]);
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
