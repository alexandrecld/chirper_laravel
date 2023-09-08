<?php

namespace App\Http\Controllers;

use App\Models\Chirper;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Redirector|RedirectResponse|View
     */
    public function index(): View|Redirector|RedirectResponse|Application
    {
        $postAnswers = Post::with('post', 'user')->latest()->get();
        return view('posts.index', compact('postAnswers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Redirector|RedirectResponse|View
     */
    public function create(): View|Redirector|RedirectResponse|Application
    {
        $posts = Chirper::all();
        return view('posts.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $data = $request->validate([
            "text" => 'required|string',
            "post_id" => 'required|int',
            "user_id" => 'required|int',
        ]);

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Réponse enregistrée avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse|View
     */
    public function show(int $id): View|Redirector|RedirectResponse|Application
    {
        $postAnswer = Post::findOrFail($id);
        return view('posts.show', compact('postAnswer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse|View
     */
    public function edit(int $id): View|Redirector|RedirectResponse|Application
    {
        $postAnswer = Post::findOrFail($id);
        $posts = Chirper::all();
        return view('posts.edit', compact('postAnswer', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, int $id): Redirector|RedirectResponse|Application
    {
        $postAnswer = Post::findOrFail($id);
        $data = $request->validate([
            "text" => 'required|string',
            "post_id" => 'required|int',
        ]);

        $postAnswer->update($data);

        return redirect()->route('posts.index')->with('success', 'Réponse mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $posts
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Post $posts): Redirector|RedirectResponse|Application
    {
        $user = auth()->user();
        if( $user->id === $posts->user_id ) {
            $posts->delete();
            return redirect(route('posts.index'))->with('success', 'Réponse supprimée avec succès!');
        } else {
            return redirect(route('posts.index'))->with('error', 'Vous n\'avez pas la permission de supprimer cette réponse');
        }
    }
}
