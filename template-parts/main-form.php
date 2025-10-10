<?php
$bg_main_form = get_field('bg_main_form');
$formularz_cnt = get_field('formularz_cnt');
?>

<section class="main-form py-4 py-lg-5" style="background-image: url('<?php echo $bg_main_form; ?>')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <?php echo $formularz_cnt; ?>
            </div>
        </div>
    </div>
</section>