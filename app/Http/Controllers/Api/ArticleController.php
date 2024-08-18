<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;

class ArticleController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('categories')->get();
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $article = Article::create($request->all());
        $article->categories()->sync($request->input('categories'));
        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::with('categories')->find($id);
        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }
        $article->update($request->all());
        $article->categories()->sync($request->input('categories'));
        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }
        $article->delete();
        return response()->json(['message' => 'Article deleted successfully']);
    }

    //add tags

    public function addTags(Request $request, $id)
    {
        $article = $this->getArticle($id);
        if (!$article) {
            return $this->notFoundResponse();
        }

        $tags = $this->getTagsFromRequest($request);
        if (!$tags) {
            return $this->badRequestResponse('No tags provided');
        }

        $article->tags()->sync($this->createOrGetTags($tags));

        return $this->successResponse($article->load('tags'));
    }

    private function getArticle($id)
    {
        return Article::find($id);
    }

    private function getTagsFromRequest(Request $request)
    {
        return $request->input('tags');
    }

    private function createOrGetTags(array $tags)
    {
        return collect($tags)->map(function ($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        })->all();
    }

    private function notFoundResponse()
    {
        return response()->json(['error' => 'Article not found'], 404);
    }

    private function badRequestResponse($message)
    {
        return response()->json(['error' => $message], 400);
    }

    private function successResponse($data)
    {
        return response()->json($data);
    }
}
