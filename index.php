<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/icons/pro.css">

    <script src="assets/js/main.js" defer></script>
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Sanders rekenmachine</title>
</head>
<body class="d-flex flex-column flex-md-row w-100 vh-100">

    <aside class="previous-container bg-light p-4 align-items-center">
        <h2>Vorige berekeningen</h2>
        <hr>
        <ul class="previous list-unstyled"></ul>
        <button class="delete-all btn-danger">Verwijder alles</button>
    </aside>

    <main class="d-flex flex-column p-4">
        <h1 class="mb-2">Sanders rekenmachine</h1>

        <div class="alert alert-warning" style="display: none;">
            <button type="button"><i class="fa-solid fa-xmark"></i></button>
            <p></p>
        </div>

        <hr>

        <form class="d-flex flex-column align-items-start">
            <input type="text" class="string-sum w-100 p-1 mb-2" placeholder="Type hier je rekensom">
            <button id="calculate-string" type="button" class="btn-primary">Bereken</button>
        </form>

        <hr>

        <form class="table table-bordered">
            <h2>Verhoudingstabel</h2>
            <table class="table table-light border-secondary">
                <tr>
                    <td><input type="number" id="cell1" class="border border-secondary w-100"></td>
                    <td><input type="number" id="cell2" class="border border-secondary w-100"></td>
                </tr>
                <tr>
                    <td><input type="number" id="cell3" class="border border-secondary w-100"></td>
                    <td><input type="number" id="cell4" class="border border-secondary w-100"></td>
                </tr> 
            </table>
            <button type="button" id="calculate-table" class="btn-primary">Bereken</button>
        </form>

        <hr>

        <textarea class="notes w-100 p-1" id="notes" placeholder="Notities"></textarea>

    </main>
</body>
</html>