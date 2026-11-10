<x-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Editar libro</h1>
                    <a href="{{ route('books.show', $book['id']) }}" class="btn btn-outline-secondary">Volver</a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('books.update', $book['id']) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input id="title" name="title" type="text" class="form-control" value="{{ old('title', $book['title']) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Autor</label>
                                <input id="author" name="author" type="text" class="form-control" value="{{ old('author', $book['author']) }}" required>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="genre" class="form-label">Género</label>
                                    <input id="genre" name="genre" type="text" class="form-control" value="{{ old('genre', $book['genre']) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="publication_year" class="form-label">Año de publicación</label>
                                    <input id="publication_year" name="publication_year" type="number" class="form-control" value="{{ old('publication_year', $book['publication_year']) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="5" required>{{ old('description', $book['description']) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('books.show', $book['id']) }}" class="btn btn-outline-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar libro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
