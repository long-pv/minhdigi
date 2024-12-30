<?php
get_header();
?>
<div class="container">
    <?php
    echo get_the_title();
    the_content();
    ?>
</div>
<?php
get_footer();
