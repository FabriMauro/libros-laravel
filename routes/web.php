<?php

use App\Models\User;
// Importa mis controladores para poder usarlos en las rutas
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\App ;
// Importa mi modelo Book para poder usarlo en las rutas
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

function booksCatalog()
{
    return Book::all()->toArray();
}

//Rutas para la gestión de libros
Route::get('/', [HomeController::class, 'index'])->name('index');
// Ruta para mostrar la lista de libros
Route::get('/libros', [BookController::class, 'index'])->name('books.index');

Route::get('/libros/crear', function () {
    return view('books.create');
})->name('books.create');

Route::post('/libros', function (Request $request) {
    $books = booksCatalog();
    $books[] = [
        'id' => count($books) + 1,
        'title' => $request->input('title'),
        'author' => $request->input('author'),
        'genre' => $request->input('genre'),
        'publication_year' => (int) $request->input('publication_year'),
        'description' => $request->input('description'),
    ];

    return redirect()->route('books.index')->with('success', 'Libro añadido correctamente.');
})->name('books.store');

Route::get('/libros/{id}/editar', function ($id) {
    $book = array_find(booksCatalog(), fn ($book) => (int) $book['id'] === (int) $id);

    if (! $book) {
        abort(404);
    }

    return view('books.edit', ['book' => $book]);
})->name('books.edit');

Route::put('/libros/{id}', function (Request $request, $id) {
    $books = booksCatalog();
    $index = array_search((int) $id, array_map(fn ($book) => (int) $book['id'], $books), true);

    if ($index === false) {
        abort(404);
    }

    $books[$index] = [
        'id' => (int) $id,
        'title' => $request->input('title'),
        'author' => $request->input('author'),
        'genre' => $request->input('genre'),
        'publication_year' => (int) $request->input('publication_year'),
        'description' => $request->input('description'),
    ];

    return redirect()->route('books.show', $id)->with('success', 'Libro actualizado correctamente.');
})->name('books.update');

Route::delete('/libros/{id}', function ($id) {
    return redirect()->route('books.index')->with('success', 'Libro eliminado correctamente.');
})->name('books.destroy');
// Ruta para visualizar un libro
Route::get('libros/{book}', [BookController::class, 'show'])->name('books.show');


Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        $loginAction = route('login');
        $registerUrl = route('register');
        $csrf = csrf_token();

        return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; display: grid; place-items: center; min-height: 100vh; }
        .card { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,.08); width: min(100%, 420px); }
        h1 { margin-top: 0; }
        label { display: block; margin-top: 1rem; font-weight: 600; }
        input { width: 100%; box-sizing: border-box; padding: .75rem; margin-top: .35rem; border-radius: 8px; border: 1px solid #d1d5db; }
        button { margin-top: 1.25rem; width: 100%; background: #111827; color: white; border: none; padding: .8rem; border-radius: 8px; cursor: pointer; }
        a { display: inline-block; margin-top: 1rem; color: #2563eb; text-decoration: none; }
        .error { color: #b91c1c; margin-top: .75rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Iniciar sesión</h1>
        <form method="POST" action="{$loginAction}">
            <input type="hidden" name="_token" value="{$csrf}">

            <label for="email">Correo</label>
            <input id="email" type="email" name="email" value="" required autofocus>

            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
        <a href="{$registerUrl}">Crear cuenta</a>
    </div>
</body>
</html>
HTML;
    })->name('login');

    Route::post('login', function (Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Las credenciales no coinciden.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    });

    Route::get('register', function () {
        $registerAction = route('register');
        $loginUrl = route('login');
        $csrf = csrf_token();

        return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear cuenta</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; display: grid; place-items: center; min-height: 100vh; }
        .card { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,.08); width: min(100%, 420px); }
        h1 { margin-top: 0; }
        label { display: block; margin-top: 1rem; font-weight: 600; }
        input { width: 100%; box-sizing: border-box; padding: .75rem; margin-top: .35rem; border-radius: 8px; border: 1px solid #d1d5db; }
        button { margin-top: 1.25rem; width: 100%; background: #111827; color: white; border: none; padding: .8rem; border-radius: 8px; cursor: pointer; }
        a { display: inline-block; margin-top: 1rem; color: #2563eb; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Crear cuenta</h1>
        <form method="POST" action="{$registerAction}">
            <input type="hidden" name="_token" value="{$csrf}">

            <label for="name">Nombre</label>
            <input id="name" type="text" name="name" value="" required>

            <label for="email">Correo</label>
            <input id="email" type="email" name="email" value="" required>

            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required>

            <label for="password_confirmation">Confirmar contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>

            <button type="submit">Registrarme</button>
        </form>
        <a href="{$loginUrl}">Ya tengo cuenta</a>
    </div>
</body>
</html>
HTML;
    })->name('register');

    Route::post('register', function (Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $logoutAction = route('logout');
        $csrf = csrf_token();

        return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; display: grid; place-items: center; min-height: 100vh; }
        .card { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,.08); width: min(100%, 480px); }
        form { margin-top: 1rem; }
        button { background: #dc2626; color: white; border: none; padding: .8rem 1rem; border-radius: 8px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Bienvenido</h1>
        <p>Has iniciado sesión correctamente.</p>
        <form method="POST" action="{$logoutAction}">
            <input type="hidden" name="_token" value="{$csrf}">
            <button type="submit">Cerrar sesión</button>
        </form>
    </div>
</body>
</html>
HTML;
    })->name('dashboard');

    Route::post('/logout', function (Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    })->name('logout');
});
