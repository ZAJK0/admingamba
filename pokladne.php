<?php
require 'config.php';
include 'parts/head.php'
?>

<body>
    <?php include "parts/nav.php"?>
    <section class="mt-5 d-flex justify-content-center flex-row">
        <div class=" d-flex justify-content-center flex-row flex-wrap pokladne">
        <?php
        for($i=0;$i<12;$i++){
        ?>
        <a href="wait.php" class="m-3 pokladnaCard section">
            <img class="mt-4" src="img/pokladna.svg" alt="">
            <p class="mb-4 mt-3">Pokladna <?=$i+1?></p>
        </a>
        <?php
        }
        ?>
        </div>
    </section>
</body>
</html>