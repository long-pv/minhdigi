<?php
get_header();
$current_category = get_queried_object();
echo $current_category->name;
?>

<?php
get_footer();
