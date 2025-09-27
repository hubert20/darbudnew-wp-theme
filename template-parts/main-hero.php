<?php
$banner_cnt = get_field('banner_cnt');
$banner_grafika = get_field('banner_grafika');
?>

<div class="px-lg-5 py-4 py-lg-5">
    <div class="container-fluid text-center hero_wrap position-relative" style="background-image: url('<?php echo $banner_grafika; ?>')">
        <?php echo $banner_cnt; ?>
    </div>
</div>