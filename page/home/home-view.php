            <div class="jumbotron">
                <div class="container">
                    <img class="logo" src="../web/css/Paleo-white.svg" alt="Cooking Paleo Logo">
                    <p>Your Place for everything Paleo</p>
                    <?php
                    if (!isset($_SESSION['email'])) {
                        echo '<a class="btn btn-primary btn-lg" href="index.php?module=user&page=add-edit" role="button">Register</a>';
                    }
                    ?>
                </div>
            </div>