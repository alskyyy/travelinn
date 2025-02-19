<?php if(Route::currentRouteName() == 'onboarding' || Route::currentRouteName() == 'home'): ?>
    <style>
        .navbar {
            /* Allows content to overlap */
            width: 100%;
            z-index: 0;
            /* Ensures navbar stays on top */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: transparent;
            /* Keeps navbar transparent */
            padding: 20px 10px;
            font-family: "Montserrat", serif;
            /* Adds a bottom border with transparency to act as a shadow */
            z-index: 3;
        }

        .navbar a:not(.dropdown-item) {
            text-decoration: none;
            color: #ffffff;
            margin: 0 15px;
            font-size: 16px;
            position: relative;
            padding-bottom: 5px;
        }

        .navbar a:hover {
            color: #ffffff;
        }

        .navbar a.active {
            color: #ffffff !important;
        }

        .navbar a.active::after {
            content: "";
            display: block;
            width: 100%;
            height: 2px;
            background-color: #90ee90;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .navbar-brand.fw-semibold {
            color: #ffffff;
        }

        .nav-link.fw-medium {
            color: #ffffff;
        }
    </style>
<?php else: ?>
    <style>
        .navbar {
            /* Allows content to overlap */
            width: 100%;
            z-index: 0;
            /* Ensures navbar stays on top */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            /* Keeps navbar transparent */
            padding: 20px 10px;
            font-family: "Montserrat", serif;
            border-bottom: 5px solid rgba(125, 125, 125, 0.25);
            /* Adds a bottom border with transparency to act as a shadow */
            z-index: 3;
        }

        .navbar a:not(.dropdown-item) {
            text-decoration: none;
            color: #000;
            margin: 0 15px;
            font-size: 16px;
            position: relative;
            padding-bottom: 5px;
        }

        .navbar a:hover {
            color: #000;
        }

        .navbar a.active {
            color: #000;
        }

        .navbar a.active::after {
            content: "";
            display: block;
            width: 100%;
            height: 2px;
            background-color: #90ee90;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .navbar-brand.fw-semibold {
            color: #000000;
        }

        .nav-link.fw-medium {
            color: #000000;
        }
    </style>
<?php endif; ?>

<?php if(auth()->guard()->check()): ?>
    <style>
        .animate {
            animation-duration: 0.2s;
            animation-fill-mode: both;
        }

        @keyframes slideIn {
            0% {
                transform: translateY(1rem);
                opacity: 0;
            }

            100% {
                transform: translateY(0rem);
                opacity: 1;
            }
        }

        .slideIn {
            animation-name: slideIn;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-item.text-danger:hover {
            background-color: #fff5f5;
        }

        .dropdown-menu {
            z-index: 1050;
            /* Ensure dropdown is in front of other elements */
        }
    </style>
<?php endif; ?>

<nav class="navbar navbar-expand-md bg-transparent">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold" href="<?php echo e(route('home')); ?>"><?php echo e(config('app.name', 'Laravel')); ?></a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link fw-medium <?php echo e($active_navbar == 'onboarding' ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium <?php echo e($active_navbar == 'recommendations' ? 'active' : ''); ?>" href="<?php echo e(route('recommendations')); ?>">Recommendations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium <?php echo e($active_navbar == 'bookmarks' ? 'active' : ''); ?>" href="<?php echo e(route('bookmarks')); ?>">Bookmarks</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                    </li>
                    <?php if(Route::has('register')): ?>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-medium d-flex align-items-center gap-2" id="navbarDropdown" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle" src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(Auth::user()->name)); ?>&background=90EE90&color=fff" alt="Profile" width="32" height="32">
                            <?php echo e(Auth::user()->name); ?>

                        </a>

                        <div class="dropdown-menu dropdown-menu-end animate slideIn" aria-labelledby="navbarDropdown" style="margin-top: 5%;">
                            <div class="px-4 py-3 border-bottom" id="profile">
                                <div class="fw-semibold"><?php echo e(Auth::user()->name); ?></div>
                                <div class="small text-muted"><?php echo e(Auth::user()->email); ?></div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <?php if(Auth::user()->role === 'admin'): ?>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="<?php echo e(route('admin.dashboard.index')); ?>">
                                    <i class="fas fa-tachometer-alt"></i> Kelola Destinasi
                                </a>
                            <?php endif; ?>

                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> <?php echo e(__('Logout')); ?>

                            </a>

                            <form id="logout-form" style="display: none;" action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\Users\ASUS\Documents\GitHub\Travelin\resources\views/components/navbar.blade.php ENDPATH**/ ?>