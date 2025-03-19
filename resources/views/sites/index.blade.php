<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Панель управления</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="font-sans antialiased">
<div class="container mt-5">
    <div class="card p-4">
        <h3 class="card-title mb-4">Добавить сайт</h3>
        <form method="POST" action="{{ route('sites.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Введите название" required>
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="url" class="form-control" id="url" name="url" placeholder="Введите URL" required>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>

    <div class="mt-5">
        <h4>Список сайтов</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Store ID</th>
                <th scope="col">Название</th>
                <th scope="col">URL</th>
                <th scope="col">Список кликов</th>
                <th scope="col">Статистика</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sites as $site)
                <tr>
                    <td><strong>{{ $site->id }}</strong></td>
                    <td><strong>{{ $site->name }}</strong></td>
                    <td><a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a></td>
                    <td>
                        <a href="/clicks/{{ $site->id }}" class="btn btn-info" target="_blank">
                            Перейти
                        </a>
                    </td>
                    <td>
                        <a href="/clicks/stats/{{ $site->id }}" class="btn btn-info" target="_blank">
                            Перейти
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
