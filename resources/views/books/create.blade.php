<x-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Añadir libro</h1>
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">Volver</a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('books.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Autor</label>
                                <input id="author" name="author" type="text" class="form-control" value="{{ old('author') }}" required>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="genre" class="form-label">Género</label>
                                    <input id="genre" name="genre" type="text" class="form-control" value="{{ old('genre') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="publication_year" class="form-label">Año de publicación</label>
                                    <input id="publication_year" name="publication_year" type="number" class="form-control" value="{{ old('publication_year') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar libro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
