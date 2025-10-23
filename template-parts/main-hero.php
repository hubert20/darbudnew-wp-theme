<?php
$banner_cnt = get_field('banner_cnt');
$banner_grafika = get_field('banner_grafika');
?>

<div class="hero-main px-lg-5 pb-lg-5">
    <div class="container-fluid text-center hero-main--wrap position-relative" style="background-image: url('<?php echo $banner_grafika; ?>')">
        <?php echo $banner_cnt; ?>
        <div class="custom-shape-divider-bottom-1761251086">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M598.97 114.72L0 0 0 120 1200 120 1200 0 598.97 114.72z" class="shape-fill"></path>
            </svg>
        </div>
    </div>
</div>