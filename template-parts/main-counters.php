<?php
$form_bg = get_field('form_bg');
$form_cnt = get_field('form_cnt');
$count_cnt = get_field('licznik_cnt');
?>
<!-- Contact Form -->
<section class="form-banner" id="form-banner" style="background-image: url('<?php echo $form_bg; ?>');">
    <div class="form-banner__bg-form py-4 py-lg-5">
        <div class="container mb-lg-3">
            <?php echo $form_cnt; ?>
            <?php echo $count_cnt; ?>
        </div>
    </div>
</section>