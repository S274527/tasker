<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />

        <title><?php $page_title = (isset($title)) ? $title.' - Tasker' : 'Tasker' ; echo $page_title?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="keywords" content="Task | Projects | Task Management" />

        <meta name="description" content="Tasker is a task management project" />

        <meta name="author" content="" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="<?=base_url('assets/img/favicons/apple-touch-icon.png')?>" sizes="180x180">
        <link rel="apple-touch-icon" href="<?=base_url('assets/img/favicons/android-icon-192x192')?>" sizes="192x192">
        <link rel="icon" href="<?=base_url('assets/img/favicons/favicon-32x32.png')?>" sizes="32x32" type="image/png">
        <link rel="icon" href="<?=base_url('assets/img/favicons/favicon-16x16.png')?>" sizes="16x16" type="image/png">
        <link rel="manifest" href="<?=base_url('assets/img/favicons/manifest.json')?>">
        <link rel="mask-icon" href="<?=base_url('assets/img/favicons/safari-pinned-tab.svg')?>" color="#712cf9">
        <link rel="icon" href="<?=base_url('assets/img/favicons/favicon.ico')?>">

        <?php $this->load->view('layout/login_head_block'); ?>

    </head>


    <body>

        <?php $this->load->view('layout/header_block'); ?>


        <!-- Page Main -->

        <?php $this->load->view($inner_template); ?>

        <!-- Page Main End-->

        <div class="d-flex justify-content-center position-absolute bottom-0 w-100 pb-2 text-white-50">&copy; <?= date('Y')?> - Tasker</div>

        <?php $this->load->view('layout/footer_js_block'); ?>


    </body>

</html>