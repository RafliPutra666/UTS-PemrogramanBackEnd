<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Menampilkan semua data
    public function index()
    {
        $media = Media::all();

        if ($media->count() > 0) {
            $response = [
                'message' => "Menampilkan seluruh resource",
                'data' => $media,
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'message' => "Data is empty"
            ];
            return response()->json($response, 200);
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
    // Menambahkan data
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'content' => 'required',
            'url' => 'required',
            'url_image' => 'required',
            'published_at' => 'required',
            'category' => 'required',
        ]);
        $media = Media::create($validate);

        $data = [
            'message' => "Menampilkan resource yang berhasil ditambahkan",
            'data' => [
                'media' => $media,
            ],
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    // Menambahkan data lebih detail
    public function show(string $id)
    {
        $media = Media::find($id);

    if ($media) {
        $response = [
            'message' => "Menampilkan detail resource". $id,
            'data' => [
                'media' => $media,
            ],
        ];
        return response()->json($response, 200);
    } else {
        $response = [
            'message' => "Resource not found",
            'data' => [
                'media' => $media,
            ],
        ];
        return response()->json($response, 404);
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    //  Mengupdate data
    public function update(Request $request, string $id)
    {
        $media = Media::find($id);

        if ($media) {
            $media->update([
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'content' => $request->content,
                'url' => $request->url,
                'url_image' => $request->url_image,
                'published_at' => $request->published_at,
                'category' => $request->category,
            ]);
            $response = [
                'message' => "Resource update is successfully",
                'data' => [
                    'media' => $media,
                ],
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'message' => "Resource not found",
            ];
            return response()->json($response, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // Menghapus data
    public function destroy(string $id)
    {
        $media = Media::find($id);

        if ($media) {
            $response = [
                'message' => "Resource delete is successfully". $id,
                'data' => [
                    'media' => $media,
                ],
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'message' => "Resource not found",
            ];
            return response()->json($response, 404);
        }
    }

    public function search(Request $request) { 
        $title = $request->title; 
 
        $media = Media::where('title', 'LIKE', '%$title%')->get(); 
 
        if ($media->isEmpty()) { 
            return response()->json([ 
                'message' => 'Resource Not Found' 
            ], 404); 
        } else { 
            return response()->json([ 
                'message' => 'Get Searched Resource' 
            ], 200); 
        } 
    }

    // menampilkan category sport
    public function sport(Request $request) { 
        $category = $request->category; 
 
        $media = Media::where('category', 'sport')->get(); 
 
        if ($media->isEmpty()) { 
            return response()->json([ 
                'message' => 'Data is empty', 
                'total' => 0 
            ], 404); 
        } else { 
            return response()->json([ 
                'message' => 'Get Sport Resource', 
                'count' => $media->count(),  
                'total' => Media::where('category', 'sport')->count(),  
                'data' => $media 
            ], 200); 
        } 
    }

    public function finance() 
    { 
        // Mengambil category finance 
        $media = Media::where('category', 'finance')->get(); 
 
        return response()->json([ 
            'status' => 'Get Finance Resource', 
            'data' => $media 
        ], 200); 
    }

    // Mengambil category automotive
    public function automotive() 
    { 
        $media = Media::where('category', 'automotive')->get(); 
 
        return response()->json([ 
            'status' => 'Get Finance Resource', 
            'data' => $media 
        ], 200); 
    }
}
