<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Sport;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::all();
        return response()->json($media);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Sport $sport)
    { {
            $request->validate([
                'media' => 'required|array',
                'media.*' => 'required|mimes:jpg,jpeg,png,mp4,avi,mov|max:10240',
            ]);

            foreach ($request->file('media') as $file) {
                $media = new Media();
                $media->sport_id = $sport->id;
                $media->type = $this->getMediaType($file);
                $media->file_name = $file->getClientOriginalName();
                $media->file_path = $this->storeMediaFile($file);
                $media->save();
            }

            return response()->json(['message' => 'Media uploaded successfully!'], 201);
        }
    }

    private function getMediaType($file)
    {
        $extension = $file->getClientOriginalExtension();
        if (in_array($extension, ['mp4', 'avi', 'mov'])) {
            return 'video';
        } else {
            return 'image';
        }
    }

    private function storeMediaFile($file)
    {
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/media', $filename);
        return 'media/' . $filename;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sport $sport)
    {
        $request->validate([
            'media' => 'required|array',
            'media.*' => 'required|mimes:jpg,jpeg,png,mp4,avi,mov|max:10240', // adjust the mime types and max size as needed
        ]);

        foreach ($request->file('media') as $file) {
            $media = Media::where('sport_id', $sport->id)->where('file_name', $file->getClientOriginalName())->first();
            if ($media) {
                $media->file_path = $this->storeMediaFile($file);
                $media->save();
            } else {
                $media = new Media();
                $media->sport_id = $sport->id;
                $media->type = $this->getMediaType($file);
                $media->file_name = $file->getClientOriginalName();
                $media->file_path = $this->storeMediaFile($file);
                $media->save();
            }
        }

        return response()->json(['message' => 'Media updated successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        $media->delete();
        return response()->json(['message' => 'Media deleted successfully!'], 200);
    }
}
