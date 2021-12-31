<head>
    <meta name="author" content="Konrad Bryłowski">
    <title>Galeria kawy</title>
    <link rel="stylesheet" type="text/css" href="static/css/style.css">
</head>
<body>
    <header>
        <a href="/"><img src="" alt="Logo"></a><br>
        <h1>Galeria kawy</h1>
    </header>
    <nav>
        <a href="/gallery">Galeria</a><br>
        <a href="/upload">Prześlij zdjęcie</a>
        <?php
            if (empty($_SESSION['user_id'])) {
            echo '<a href="/login">Zaloguj się</a> ';
            echo '<a href="/register">Zarejestruj się</a>';
            } else {
                echo '<a href="/logout">Wyloguj</a>';
            }
        ?>
    </nav>
