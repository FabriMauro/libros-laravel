<x-layout>
     <!-- Seção Hero -->
    <div class="bg-primary text-white py-5 text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Bem-vindo à Sua Biblioteca de Livros</h1>
            <p class="lead mb-4">Organize e gerencie sua coleção de livros com facilidade</p>
            <a href="{{ route('books.index') }}" class="btn btn-light btn-lg px-5 fw-semibold">Navegar pela Coleção</a>
        </div>
    </div>

    <!-- Livros Recentes -->
    <div class="container py-5">
        <h2 class="mb-4">Livros Adicionados Recentemente</h2>
        <div class="row g-4">
            <!-- Card de Livro 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://placehold.co/400x300/6c757d/ffffff?text=Capa+do+Livro" alt="Capa do Livro" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">O Grande Gatsby</h5>
                        <p class="text-muted mb-2">F. Scott Fitzgerald</p>
                        <p class="small text-muted mb-3">Publicado: 1925</p>
                        <a href="book-view.html" class="card-link">Ver Detalhes →</a>
                    </div>
                </div>
            </div>

            <!-- Card de Livro 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://placehold.co/400x300/6c757d/ffffff?text=Capa+do+Livro" alt="Capa do Livro" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">O Apanhador no Campo de Centeio</h5>
                        <p class="text-muted mb-2">Harper Lee</p>
                        <p class="small text-muted mb-3">Publicado: 1960</p>
                        <a href="book-view.html" class="card-link">Ver Detalhes →</a>
                    </div>
                </div>
            </div>

            <!-- Card de Livro 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://placehold.co/400x300/6c757d/ffffff?text=Capa+do+Livro" alt="Capa do Livro" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">1984</h5>
                        <p class="text-muted mb-2">George Orwell</p>
                        <p class="small text-muted mb-3">Publicado: 1949</p>
                        <a href="book-view.html" class="card-link">Ver Detalhes →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
