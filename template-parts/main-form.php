<?php
$bg_main_form = get_field('bg_main_form');
$formularz_cnt = get_field('formularz_cnt');
?>

<section class="main-form py-4 py-lg-5" style="background-image: url('<?php echo $bg_main_form; ?>')">
    <div class="container">
        <div class="row justify-content-center align-items-end">
            <div class="col-lg-4">
                <div class="main-form--left-box position-relative p-4">
                    <h2>Zbudujemy Twój szkieletowy dom</h2>
                    <p>Na Twoją kieszeń, bez stresu, gotowy do zamieszkania</p>
                    <button type="button" class="btn btn-primary video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/Qf97y9Zl7RI?si=jpcQgvQ8uiQxD87l" data-bs-target="#videoModal">
                        Play Video 1 - autoplay
                    </button>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="p-4 bg-white contact-form-box">
                    <?php echo apply_shortcodes('[contact-form-7 id="3524678" title="Formularz kontaktowy"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>