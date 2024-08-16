    
    <?php
        if ( isset($_module) && $_module == 1) {
            $path = "../";
        } else {
            $path = "";
        }
    ?>

    <!-- Jquery Libraries Links -->
    <script type="text/javascript" src="<?php echo $path; ?>js/footer.js?clear_cache=<?php echo time();?>"></script>

    