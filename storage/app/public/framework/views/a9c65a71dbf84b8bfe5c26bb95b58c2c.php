<?php $__env->startPush('styles'); ?>
    <style>
        .hero-section {
            background-image: url('<?php echo e(asset('storage/onboarding.png')); ?>');
            background-size: cover;
            background-position: center;
            min-height: 60vh;
            top: -5%;
            position: relative;
        }

        .search-container {
            max-width: 500px;
        }
    </style>

    <style>
        .custom-input-wrapper {
            border: 1px solid #a0d2c6;
            border-radius: 20px;
            padding: 8px;
            display: flex;
            align-items: center;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .custom-input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 16px;
        }

        .custom-input:focus {
            box-shadow: none;
        }

        .custom-button {
            background-color: #a0d2c6;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custom-button:hover {
            background-color: #92c4b8;
        }

        .custom-button i {
            margin-right: 5px;
        }
    </style>

    <style>
        .custom-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            background: #fff;
            width: 100%;
            height: 400px;
            /* Set a fixed height for the card */
        }

        .custom-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensure the image covers the card area */
            display: block;
        }

        .custom-card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.4);
            color: #ffffff;
            padding: 16px;
            text-align: center;
        }

        .custom-card-title {
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 4px;
        }

        .custom-card-subtitle {
            font-size: 1rem;
            margin-bottom: 12px;
        }

        .custom-button {
            background-color: #8dd3bb;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            /* Ensure the link looks like a button */
        }

        .custom-button:hover {
            background-color: #92c4b8;
        }

        .custom-button i {
            margin-right: 5px;
        }

        .category-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(141, 211, 187, 0.9);
            padding: 6px 12px;
            border-radius: 20px;
            color: #fff;
            text-transform: capitalize;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <div class="hero-section d-flex align-items-center text-white" style="z-index: 1">
        <div class="container text-center py-5">
            <h2 class="fw-bold mb-4">Helping Others</h2>
            <h1 class="display-4 fw-bold mb-4">LIVE & TRAVEL</h1>
            <p class="lead mb-4">Temukan destinasi lebih mudah</p>

            <div class="container mt-5">
                <form class="custom-input-wrapper py-2 px-3" id="searchForm">
                    <input class="custom-input" id="searchInput" name="query" type="text" placeholder="Search..." autocomplete="off">
                    <button class="custom-button" type="submit">
                        <i class="fas fa-paper-plane pe-2"></i> Cari Tempat
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Search Results -->
    <div class="container py-5" style="z-index: 1">
        <h3 class="mb-4">Hasil Pencarian</h3>
        <div class="row g-4" id="searchResults">
            <!-- Search results will be loaded here -->
            <div class="m-0 py-3 px-2">
                <div class="alert alert-info text-center shadow-sm" role="alert">
                    Gunakan kotak pencarian di atas untuk menemukan tempat yang kamu inginkan.
                </div>
            </div>
        </div>
    </div>

    <!-- Recommendations -->
    <div class="container py-5" style="z-index: 1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="m-0">Rekomendasi</h3>
            <a class="btn btn-transparent border border-1 text-dark" href="<?php echo e(route('recommendations')); ?>">
                <i class="fas fa-list pe-2"></i> Lihat Banyak Tempat
            </a>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 d-flex justify-content-center">
                    <div class="custom-card">
                        <?php if($place['photo_url']): ?>
                            <img src="<?php echo e($place['photo_url']); ?>" alt="<?php echo e($place['name']); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(asset('images/placeholder.png')); ?>" alt="Placeholder Image">
                        <?php endif; ?>
                        <div class="category-badge">
                            <?php echo e($place['category']); ?>

                        </div>
                        <div class="custom-card-overlay">
                            <h5 class="custom-card-title"><?php echo e($place['name']); ?></h5>
                            <p class="custom-card-subtitle"><?php echo e($place['address']); ?></p>
                            <a class="custom-button text-dark" href="<?php echo e(route('place.detail_v2', ['placeId' => $place['id']])); ?>">
                                <i class="fas fa-paper-plane pe-2"></i> Lihat
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Bookmarks -->
    <?php if(auth()->guard()->check()): ?>
        <div class="container py-5" style="z-index: 1">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="m-0">Bookmark</h3>
                <a class="btn btn-transparent border border-1 text-dark" href="<?php echo e(route('bookmarks')); ?>">
                    <i class="fas fa-list pe-2"></i> Lihat Semua
                </a>
            </div>
            <div class="row g-4">
                <?php $hasBookmarks = false; ?>

                <?php $__currentLoopData = $placesBookmarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $hasBookmarks = true; ?>
                    <div class="col-md-6 d-flex justify-content-center">
                        <div class="custom-card">
                            <?php if($place['photo_url']): ?>
                                <img src="<?php echo e($place['photo_url']); ?>" alt="<?php echo e($place['name']); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('images/placeholder.png')); ?>" alt="Placeholder Image">
                            <?php endif; ?>
                            <div class="custom-card-overlay">
                                <h5 class="custom-card-title"><?php echo e($place['name']); ?></h5>
                                <p class="custom-card-subtitle"><?php echo e($place['address']); ?></p>
                                <a class="custom-button text-dark" href="<?php echo e(route('place.detail_v2', ['placeId' => $place['place_id']])); ?>">
                                    <i class="fas fa-paper-plane pe-2"></i> Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(!$hasBookmarks): ?>
                    <div class="m-0 py-3 px-2">
                        <div class="alert alert-warning text-center shadow-sm" role="alert">
                            Belum ada tempat yang di-bookmark. Silahkan lihat <a class="alert-link" href="<?php echo e(route('recommendations')); ?>">Rekomendasi</a> untuk menambahkan tempat favoritmu.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Footer Section -->
    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();

                let query = $('#searchInput').val();

                $.ajax({
                    url: "<?php echo e(route('search')); ?>",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(response) {
                        console.log(response);

                        $('#searchResults').html(response.html);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\GitHub\Travelin\resources\views/onboarding.blade.php ENDPATH**/ ?>