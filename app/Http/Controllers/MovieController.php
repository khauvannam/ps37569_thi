<?php


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MovieController extends Controller
{
    /**
     * Get the top 10 viewed movies.
     *
     * @return JsonResponse
     */
    public function topViewedMovies(): JsonResponse
    {
        $topMovies = Movie::orderBy('view', 'desc')->limit(10)->get();

        return response()->json([
            'data' => $topMovies
        ]);
    }

    /**
     * Display a listing of movies.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $movies = Movie::all();

        return response()->json([
            'data' => $movies
        ]);
    }

    /**
     * Store a newly created movie in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'view' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $movie = Movie::create($request->all());

        return response()->json([
            'message' => 'Movie created successfully.',
            'data' => $movie
        ], 201);
    }

    /**
     * Display the specified movie.
     *
     * @param Movie $movie
     * @return JsonResponse
     */
    public function show(Movie $movie): JsonResponse
    {
        return response()->json([
            'data' => $movie
        ]);
    }

    /**
     * Update the specified movie in storage.
     *
     * @param Request $request
     * @param Movie $movie
     * @return JsonResponse
     */
    public function update(Request $request, Movie $movie): JsonResponse
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'nullable|string',
            'view' => 'nullable|integer|min:0',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $movie->update($request->all());

        return response()->json([
            'message' => 'Movie updated successfully.',
            'data' => $movie
        ]);
    }

    /**
     * Remove the specified movie from storage.
     *
     * @param Movie $movie
     * @return JsonResponse
     */
    public function destroy(Movie $movie): JsonResponse
    {
        $movie->delete();

        return response()->json([
            'message' => 'Movie deleted successfully.'
        ]);
    }

    /**
     * Show top 4 most popular movies based on views.
     *
     * @return View
     */
    public function popularMovies(): View
    {
        // Get the top 4 most popular movies based on views
        $popularMovies = Movie::orderBy('views', 'desc')->take(4)->get();

        return view('movies.popular', compact('popularMovies'));
    }

    /**
     * Show favorite movies for the authenticated user.
     *
     * @return View
     */
    public function favoriteMovies(): View
    {
        // Fetch the authenticated user
        $user = auth()->user();

        // Get the favorite movies for the authenticated user
        $favoriteMovies = $user->favoriteMovies()->with('movie')->get()->pluck('movie');

        return view('movies.favorites', compact('favoriteMovies'));
    }


    public function indexView(): View
    {
        $user = auth()->user();

        if ($user) {
            $favoriteMovies = $user->favoriteMovies()->with('movie')->take(4)->get()->pluck('movie');
        } else {
            $favoriteMovies = collect();
        }

        $existingCategoryIds = Movie::pluck('category_id')->unique()->toArray();

        // Fetch categories with valid category_ids
        $categories = Category::whereIn('id', $existingCategoryIds)
            ->with(['movies' => function ($query) {
                $query->orderBy('view', 'desc')->take(4);
            }])->take(8)->get();

        return view('movie.index', compact('favoriteMovies', 'categories'));
    }

}

