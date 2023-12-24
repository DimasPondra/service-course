<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonStoreRequest;
use App\Http\Requests\LessonUpdateRequest;
use App\Http\Resources\LessonResource;
use App\Http\Resources\LessonResourceCollection;
use App\Models\Lesson;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    private $lessonRepository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = $this->lessonRepository->get();

        return new LessonResourceCollection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->merge(['slug' => Str::slug($request->name)]);

            $data = $request->only(['name', 'slug', 'video_file_id', 'chapter_id']);

            $lesson = new Lesson();
            $this->lessonRepository->save($lesson->fill($data));

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
            'message' => 'Lesson successfully created.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully get data.',
            'data' => new LessonResource($lesson)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonUpdateRequest $request, Lesson $lesson)
    {
        try {
            DB::beginTransaction();

            $request->merge(['slug' => Str::slug($request->name)]);

            $data = $request->only(['name', 'slug', 'video_file_id', 'chapter_id']);

            $this->lessonRepository->save($lesson->fill($data));

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
            'message' => 'Lesson successfully updated.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
