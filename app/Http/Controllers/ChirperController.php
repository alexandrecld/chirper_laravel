<?php
namespace App\Http\Controllers;

use App\Models\Chirper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ChirperController extends Controller
{
    public function index(): Factory|View|Application
    {
        $chirpers = Chirper::with('posts')->get();
        return view('dashboard', compact('chirpers'));
    }

    public function store(Request $request): RedirectResponse
    {
        Chirper::create([
            'text' => $request->input('text') ?? 'Bonjour !',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Chirper $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
