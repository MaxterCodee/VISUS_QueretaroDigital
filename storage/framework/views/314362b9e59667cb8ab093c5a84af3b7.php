<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <!-- Styles -->
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


        <style>
            body {
                background-image: url('/assets/images/water.png');
                background-size: cover; /* Ajusta la imagen al tamaño del contenedor */
                background-position: center; /* Centra la imagen */
                background-repeat: no-repeat; /* Evita que la imagen se repita */
            }
        </style>
    </head>
    <body class="background-image">
        <div class="background-image font-sans text-gray-900 antialiased">
            <?php echo e($slot); ?>

        </div>

        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    </body>
</html>
<?php /**PATH /home/maxtercode/Hackatones/QueretaroDigital/resources/views/layouts/guest.blade.php ENDPATH**/ ?>