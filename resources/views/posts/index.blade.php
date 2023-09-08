<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4 shadow-md bg-white rounded-lg">

    <form method="POST" action="{{ route('posts.store') }}" class="mb-4">
        @csrf
        <div class="mb-4">
            <label for="text" class="block text-gray-600 font-bold mb-2">Texte:</label>
            <textarea name="text" id="text" rows="10"
                      class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">{{ old('text') }}</textarea>
        </div>
        <input type="submit" value="Valider"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
    </form>

    @foreach ($chirpers as $chirper)
        <div class="mb-4 p-4 bg-white shadow-md rounded-lg">
            <p class="text-xl">{{ $chirper->text }}</p>
            <p class="text-gray-600">Publier par: {{ $chirper->user->name }}</p>
            <p class="text-gray-600">Le {{ $chirper->created_at->format('d-M-Y à H:i:s') }}</p>


            <!-- Formulaire pour supprimer un post -->
            @if(auth()->id() === $chirper->user_id)
                <form method="POST" action="{{ route('posts.destroy', $chirper) }}" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Supprimer"
                           class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                </form>
            @endif

            <!-- Réponses au post -->
            @foreach($chirper->posts as $post)
                <div class="mt-4 p-4 bg-gray-200 rounded">
                    <p>{{ $post->text }}</p>
                    <p class="text-gray-600">Écrit par: {{ $post->user->name }}</p>
                </div>
            @endforeach
        </div>
    @endforeach

</div>
