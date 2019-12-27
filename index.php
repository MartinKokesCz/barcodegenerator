<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generátor dárkových poukazů</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="">Generátor dárkových poukazů</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <form action="generate.php" method="get">
                    ČÁSTKA:
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="amount" id="amount1" value="500" checked>
                        <label class="form-check-label" for="amount1">
                            500 Kč
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="amount" id="amount2" value="1000">
                        <label class="form-check-label" for="amount2">
                            1000 Kč
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="amount" id="amount3" value="2000">
                        <label class="form-check-label" for="amount3">
                            2000 Kč
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="ean">EAN kupónu:</label>
                        <input type="number" name="EAN" id="ean" required>
                    </div>
                    <input class="btn btn-primary" type="submit" name="submit" id="">
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>