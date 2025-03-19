<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>График активности пользователей</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="font-sans antialiased">
<div class="container mt-5">
    <h2 class="text-center">Распределение активности пользователя по часам</h2>
    <canvas id="clicksChart"></canvas>
</div>
<script>
    fetch('/api/clicks/stats/data/{{ $site_id }}')
        .then(response => response.json())
        .then(data => {
            const hours = data.map(item => item.hour);
            const counts = data.map(item => item.count);

            const ctx = document.getElementById('clicksChart').getContext('2d');
            const clicksChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: hours,
                    datasets: [{
                        label: 'Количество кликов',
                        data: counts,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Ошибка:', error));
</script>
</body>
</html>
