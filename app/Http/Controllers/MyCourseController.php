<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyCourseStoreRequest;
use App\Http\Resources\MyCourseResourceCollection;
use App\Models\MyCourse;
use App\Repositories\MyCourseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyCourseController extends Controller
{
    private $myCourseRepository;

    public function __construct(MyCourseRepository $myCourseRepository)
    {
        $this->myCourseRepository = $myCourseRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $myCourses = $this->myCourseRepository->get([
            'search' => [
                'user_id' => $request->user_id
            ]
        ]);

        return new MyCourseResourceCollection($myCourses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MyCourseStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only(['user_id', 'course_id']);

            $check = MyCourse::where('user_id', $request->user_id)
                                ->where('course_id', $request->course_id)
                                ->first();

            if ($check) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Data is duplicated and can't be processed."
                ], 400);
            }

            $myCourse = new MyCourse();
            $this->myCourseRepository->save($myCourse->fill($data));

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
            'message' => 'My course successfully created.'
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
    public function destroy(string $id)
    {
        //
    }
}
