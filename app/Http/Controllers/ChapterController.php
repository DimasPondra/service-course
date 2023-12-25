<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChapterStoreRequest;
use App\Http\Requests\ChapterUpdateRequest;
use App\Http\Resources\ChapterResource;
use App\Http\Resources\ChapterResourceCollection;
use App\Models\Chapter;
use App\Repositories\ChapterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    private $chapterRepository;

    public function __construct(ChapterRepository $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $chapters = $this->chapterRepository->get([
            'search' => [
                'course_id' => $request->course_id
            ]
        ]);

        return new ChapterResourceCollection($chapters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChapterStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->merge(['slug' => Str::slug($request->name)]);

            $data = $request->only(['name', 'slug', 'course_id']);

            $chapter = new Chapter();
            $this->chapterRepository->save($chapter->fill($data));

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
            'message' => 'Chapter successfully created.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully get data.',
            'data' => new ChapterResource($chapter)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChapterUpdateRequest $request, Chapter $chapter)
    {
        try {
            DB::beginTransaction();

            $request->merge(['slug' => Str::slug($request->name)]);

            $data = $request->only(['name', 'slug', 'course_id']);

            $this->chapterRepository->save($chapter->fill($data));

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
            'message' => 'Chapter successfully updated.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        if ($chapter->lessons->count() >= 1) {
            return response()->json([
                'status' => 'error',
                'message' => "Data can't be deleted as it has relationships."
            ], 400);
        }

        try {
            DB::beginTransaction();

            $chapter->delete();

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
            'message' => 'Chapter successfully deleted.'
        ], 200);
    }
}
