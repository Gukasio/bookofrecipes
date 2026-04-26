<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет - Gukasio Recipes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-dark bg-secondary mb-5">
        <div class="container">
            <span class="navbar-brand">Личный кабинет</span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Выйти</a>
        </div>
    </nav>

    <main class="container text-center">
        <div class="card bg-secondary text-white p-5 shadow">
            <h1>Рады тебя видеть, <span class="text-info"><?php echo htmlspecialchars($userName); ?></span>!</h1>
            <p class="lead mt-3">Теперь тебе доступны секретные рецепты нашего шеф-повара.</p>
            
            <div class="mt-4">
                <a href="index.html" class="btn btn-primary me-2">На главную</a>
                <a href="catalog.html" class="btn btn-info">В каталог</a>
            </div>
        </div>
    </main>

    <footer class="container text-center mt-5 py-3 border-top border-secondary">
        <small class="text-white-50">© 2026 Gukasio Recipes. Логирование активно.</small>
    </footer>
</body>
</html>