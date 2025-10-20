<?php
$bg_main_form = get_field('bg_main_form');
$formularz_cnt = get_field('formularz_cnt');
?>

<section class="main-form py-4 py-lg-5" style="background-image: url('<?php echo $bg_main_form; ?>')">
    <div class="container">
        <div class="row justify-content-center align-items-end">
            <div class="col-lg-4 pe-lg-0">
                <div class="main-form--left-box position-relative p-4 mb-3 mb-lg-0">
                    <h2 class="standard-title-4 fw-bold lh-1 text-white mb-2">Zbudujemy Twój szkieletowy dom</h2>
                    <p class="standard-title-6 text-white">Na Twoją kieszeń, bez stresu, gotowy do zamieszkania</p>
                    <div class="text-center">
                        <a role="button" type="button" class="main-form--video-btn pulse-animation video-btn pulse-animation--lg" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/Qf97y9Zl7RI?si=jpcQgvQ8uiQxD87l" data-bs-target="#videoModal">
                            <span class="video-btn"><i class="fa fa-play"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 ps-lg-0">
                <div class="p-4 bg-white contact-form-box">
                    <?php echo apply_shortcodes('[contact-form-7 id="3524678" title="Formularz kontaktowy"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>