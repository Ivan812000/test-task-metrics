<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отслеживание кликов</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h1>Отслеживание кликов на странице</h1>

<script>
    function getCsrfToken() {
        return fetch("http://127.0.0.1:8000/api/csrf-token", {
            method: "GET",
            headers: { "Accept": "application/json" }
        })
            .then(response => {
                if (!response.ok) throw new Error("Ошибка получения CSRF-токена");
                return response.json();
            })
            .then(data => data.csrf_token);
    }

    document.addEventListener("click", function (event) {
        getCsrfToken().then(csrfToken => {
            const x = event.clientX;
            const y = event.clientY;
            const timestamp = new Date().toISOString();
            const site_id = '3';
            const url = window.location.href;
            const data = { x, y, timestamp, site_id, url, _token: csrfToken };
            return fetch("http://127.0.0.1:8000/api/clicks/", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data)
            });
        })
            .then(response => response.json())
            .then(data => console.log("Клик записан:", data))
            .catch(error => console.error("Ошибка:", error));
    });
</script>
</body>
</html>
