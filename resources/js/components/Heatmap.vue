<!-- resources/js/components/Heatmap.vue -->
<template>
    <div id="heatmapContainer" style="width: 100%; height: 500px;"></div>
</template>

<script>
import h337 from 'heatmap.js'; // Импортируем heatmap.js

export default {
    props: ["siteId"], // Получаем siteId как пропс от родительского компонента
    mounted() {
        // Когда компонент монтируется, выполняем запрос для получения кликов
        fetch(`/api/clicks/${this.siteId}`)
            .then(response => response.json())
            .then(data => {
                // Создаем экземпляр heatmap.js
                let heatmapInstance = h337.create({
                    container: document.getElementById('heatmapContainer'),
                    radius: 20, // Радиус тепловой карты
                });

                // Формируем данные для тепловой карты
                let heatmapData = {
                    max: 10, // Максимальное значение для интенсивности (например, максимальное количество кликов в одном месте)
                    data: data.map(c => ({
                        x: c.x, // Координата X
                        y: c.y, // Координата Y
                        value: 1 // Интенсивность клика, например, 1 для каждого клика
                    }))
                };

                // Устанавливаем данные для тепловой карты
                heatmapInstance.setData(heatmapData);
            })
            .catch(error => {
                console.error("Ошибка при загрузке данных кликов для Heatmap", error);
            });
    }
};
</script>
