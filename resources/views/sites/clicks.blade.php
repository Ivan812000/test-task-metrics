<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Карта кликов</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/heatmap.js/2.0.2/heatmap.min.js"></script>
</head>
<body class="font-sans antialiased">
<div class="container mt-5">
    <h2 class="text-center">Карта кликов</h2>
    <div id="heatmapContainer" style="width: 100%; height: 500px; position: relative;"></div>
</div>
<script>
    fetch('/api/clicks/data/{{ $site_id }}')
        .then(response => response.json())
        .then(data => {
            const heatmap = h337.create({
                container: document.getElementById('heatmapContainer'),
                radius: 50,
                maxOpacity: 0.6,
                minOpacity: 0,
                blur: 0.9,
            });

            const heatmapData = {
                max: 10,
                data: data.map(click => ({
                    x: click.x,
                    y: click.y,
                    value: 1,
                }))
            };

            heatmap.setData(heatmapData);
        })
        .catch(error => {
            console.error('Ошибка при загрузке данных для карты кликов:', error);
        });
</script>

</body>
</html>
