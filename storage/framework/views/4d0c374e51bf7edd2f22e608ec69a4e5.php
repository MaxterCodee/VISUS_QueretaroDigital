<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            
            <li>
                <a href="<?php echo e(route('dashboard')); ?>"
                    class="flex items-center p-2 rounded-lg group
                       <?php echo e(Route::is('dashboard') ? 'text-gray-900 bg-blue-100 dark:text-white dark:bg-gray-700' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'); ?>">
                       <i class="fa-solid fa-gauge"></i>

                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            
            <li>
                <a href="<?php echo e(route('profile.show')); ?>"
                    class="flex items-center p-2 rounded-lg group
                       <?php echo e(Route::is('profile.show') ? 'text-gray-900 bg-blue-100 dark:text-white dark:bg-gray-700' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'); ?>">
                       <i class="fa-solid fa-user"></i>

                    <span class="ms-3">Perfil</span>
                </a>
            </li>


            <div class="border-t border-gray-300 dark:border-gray-700"></div>

            
            <li>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="flex items-center p-2 rounded-lg group">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="flex items-center p-2 rounded-lg group flex items-center w-full text-left <?php echo e(Route::is('logout') ? 'text-gray-900 bg-blue-100 dark:text-white dark:bg-gray-700' : 'text-gray-900 dark:text-white hover:bg-red-100 dark:hover:bg-gray-700'); ?>">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="ms-3">Cerrar sesión</span>
                    </button>
                </form>
            </li>


        </ul>
    </div>
</aside>
<?php /**PATH /home/maxtercode/Hackatones/QueretaroDigital/resources/views/components/side.blade.php ENDPATH**/ ?>