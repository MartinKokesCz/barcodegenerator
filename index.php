<?php
require_once 'header.php';
?>

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
                    <input type="number" name="EAN" id="ean">
                </div>
                <input class="btn btn-primary" type="submit" name="submit" id="">
            </form>
        </div>
    </div>
</div>
<?php

require_once 'footer.php';