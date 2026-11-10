<x-layout>
     <!-- Seção Hero -->
    <div class="bg-primary text-white py-5 text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Biembenido a Biblioteca de libros</h1>
            <p class="lead mb-4">Organize e gerencie sua coleção de livros com facilidade</p>
            <!-- Boton para indices de libros pagina -->
            <a href="{{ route('books.index') }}" class="btn btn-light btn-lg px-5 fw-semibold">Navegar a la coleccion de libros</a>
        </div>
    </div>

    <!-- Livros Recentes -->
    <div class="container py-5">
        <h2 class="mb-4">Libros añadidos recientemente</h2>
        <div class="row g-4">


<!-- Aqui renderizo los cards de los libros -->
            @foreach ($books as $book)
                 <!-- Card dinámico -->
            <div class="col-md-6 col-lg-4">
                <!-- Aqui se puede usar un componente de libro para mostrar los detalles del libro -->
                <x-book-card :book="$book" class="shadow-sm" href="link" test="jon snow" />
            </div>
            @endforeach



        </div>
    </div>

</x-layout>
