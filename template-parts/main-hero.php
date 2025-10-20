<?php
$banner_cnt = get_field('banner_cnt');
$banner_grafika = get_field('banner_grafika');
?>

<div class="hero-main">
    <div class="container-fluid text-center hero-main--wrap position-relative" style="background-image: url('<?php echo $banner_grafika; ?>')">
        <?php echo $banner_cnt; ?>
    </div>
</div>