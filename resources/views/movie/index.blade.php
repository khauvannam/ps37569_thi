<x-guest-layout>
    <main>
        <section class="hot-genres">
            <h2>Hot Genres</h2>
            <div class="genre-grid">
                @foreach($categories as $category)
                    <div class="genre">
                        <i class="fas fa-fire"></i>
                        <p>{{ $category->name }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="favorite-movies">
            <h2>Favorite Movies</h2>
            <div class="movie-grid">
                @forelse($favoriteMovies as $movie)
                    <div class="movie">
                        <img src="{{asset('img/'. $movie->image)  }}" alt="{{ $movie->name }}"/>
                        <h3>{{ $movie->name }}</h3>
                        <p>Category: {{ $movie->category->name }}</p>
                        <p>Views: {{ $movie->views }}</p>
                    </div>
                @empty
                    <p>No favorite movies found.</p>
                @endforelse
            </div>
        </section>

        <section class="popular-movies">
            <h2>Popular Movies</h2>
            <h3>{{ $category->name }} - Popular Movies</h3>
            <div class="movie-grid">
                @foreach($categories as $category)
                    <div class="category-section">
                        @foreach($category->movies as $movie)
                            <div class="movie">
                                <img src="{{ asset('img/' .$movie->image ) }}" alt="{{ $movie->name }}"/>
                                <h3>{{ $movie->name }}</h3>
                                <p>Category: {{ $movie->category->name }}</p>
                                <p>Views: {{ $movie->view }}</p>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 BHZCo. All rights reserved.</p>
    </footer>
</x-guest-layout>
