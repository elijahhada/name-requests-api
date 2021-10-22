<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awesome App company</title>
</head>
<body>
    <h1>Решение по Вашей заявке на имя {{ $data['name'] }}</h1>
    <h3>Статус {{ $data['status'] }}</h3>
    <p>Описание {{ $data['description'] }}</p>

    <p>Спасибо за Ваш запрос!</p>
</body>
</html>