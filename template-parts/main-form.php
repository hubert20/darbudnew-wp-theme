<?php
$bg_main_form = get_field('bg_main_form');
$formularz_cnt = get_field('formularz_cnt');
?>

<section class="main-form py-4 py-lg-5" style="background-image: url('<?php echo $bg_main_form; ?>')">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-8">
                <?php echo apply_shortcodes('[contact-form-7 id="3524678" title="Formularz kontaktowy"]'); ?>
            </div>
        </div>
    </div>
</section>