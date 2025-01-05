<?php $__env->startSection('title', $place->name); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .rating .stars {
            font-size: 18px;
            color: #ff8682;
        }

        .rating .score {
            background-color: #eaf5ea;
            color: #4caf50;
            font-size: 14px;
            padding: 5px 8px;
            border-radius: 4px;
            margin-right: 10px;
        }

        .rating .reviews {
            font-size: 12px;
            color: #888;
        }

        .carousel-inner {
            max-height: 100%;
            background-color: #f8f9fa;
        }

        .carousel-item {
            height: 100%;
            text-align: center;
        }

        .carousel-item img {
            max-height: 100%;
            max-width: 100%;
            width: auto;
            height: auto;
            margin: auto;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex-grow-1 p-0 m-0 pt-3">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center px-5">
            <a class="btn p-0 m-0" type="button" href="<?php echo e(route('recommendations')); ?>">
                <i class="fa-solid fa-arrow-left fs-4"></i>
            </a>
            <div class="text-center flex-grow-1">
                <h1 class="h3 fw-bold mb-0"><?php echo e($place->name); ?></h1>
                <?php
                    $rating = floatval($place->rating);
                    $fullStars = floor($rating);
                    $halfStar = $rating - $fullStars >= 0.5 ? true : false;
                ?>
                <div class="rating mt-2">
                    <p class="stars p-0 m-0">
                        <span class="score me-2"><?php echo e(number_format($place->rating, 1)); ?></span>
                        <?php for($i = 0; $i < $fullStars; $i++): ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                        <?php if($halfStar): ?>
                            <i class="fas fa-star-half-alt"></i>
                        <?php endif; ?>
                        <?php for($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++): ?>
                            <i class="far fa-star"></i>
                        <?php endfor; ?>
                        <span class="ms-2 reviews">
                            <?php
                                $ratingText = match (true) {
                                    $place->rating == 5.0 => 'Excellent',
                                    $place->rating >= 4.0 => 'Good',
                                    $place->rating >= 3.0 => 'Fair',
                                    $place->rating >= 2.0 => 'Poor',
                                    $place->rating >= 1.0 => 'Very Poor',
                                    default => 'Terrible',
                                };
                            ?>
                            <strong><?php echo e($ratingText); ?></strong> - <strong>(<?php echo e($place->review_count); ?> reviews)</strong>
                        </span>
                    </p>
                </div>
            </div>
            <?php if(auth()->guard()->check()): ?>
                <form action="<?php echo e($isBookmarked ? route('bookmarks.destroyV2', ['bookmark' => $bookmarkId]) : route('bookmarks.storeV2')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if($isBookmarked): ?>
                        <?php echo method_field('DELETE'); ?>
                    <?php endif; ?>
                    <input name="place_id" type="hidden" value="<?php echo e($place->id); ?>">
                    <button class="btn btn-link p-0 m-0" type="submit">
                        <?php if($isBookmarked): ?>
                            <i class="fa-solid fa-bookmark fs-4"></i>
                        <?php else: ?>
                            <i class="fa-regular fa-bookmark fs-4"></i>
                        <?php endif; ?>
                    </button>
                </form>
            <?php endif; ?>
        </div>

        <!-- Horizontal line -->
        <hr class="mt-2" style="border: 2px solid #000000;">

        <div class="px-5 py-2">
            <!-- Content -->
            <div class="mt-4">
                <p>
                    <strong>Alamat:</strong> <?php echo e($place->address); ?>

                    <a class="ps-1" href="<?php echo e($place->maps_link); ?>" target="_blank">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </p>
                <h4>Reviews</h4>
                <?php if(count($place->reviews) > 0): ?>
                    <?php $__currentLoopData = $place->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong><?php echo e($review['authorAttribution']['displayName'] ?? 'Anonymous'); ?></strong>
                                    <div class="rating">
                                        <?php for($i = 0; $i < $review['rating']; $i++): ?>
                                            <i class="fas fa-star text-warning"></i>
                                        <?php endfor; ?>
                                        <?php for($i = $review['rating']; $i < 5; $i++): ?>
                                            <i class="far fa-star text-warning"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <p class="card-text"><?php echo e($review['text']['text'] ?? 'No review text'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="text-muted">No reviews available for this place.</p>
                <?php endif; ?>
            </div>

            <!-- Images Carousel -->
            <div class="mt-4">
                <?php if(count($place->photos) > 0): ?>
                    <div class="carousel slide" id="placeImageCarousel" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php $__currentLoopData = $place->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button class="<?php echo e($index === 0 ? 'active' : ''); ?>" data-bs-target="#placeImageCarousel" data-bs-slide-to="<?php echo e($index); ?>" type="button" aria-current="<?php echo e($index === 0 ? 'true' : 'false'); ?>" aria-label="Slide <?php echo e($index + 1); ?>">
                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="carousel-inner rounded">
                            <?php $__currentLoopData = $place->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $photoUrl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                                    <img class="d-block w-100" src="<?php echo e($photoUrl); ?>" alt="Image <?php echo e($index + 1); ?> of <?php echo e($place->name); ?>">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(count($place->photos) > 1): ?>
                            <button class="carousel-control-prev" data-bs-target="#placeImageCarousel" data-bs-slide="prev" type="button">
                                <span class="carousel-control-prev-icon bg-secondary rounded-5 p-4" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" data-bs-target="#placeImageCarousel" data-bs-slide="next" type="button">
                                <span class="carousel-control-next-icon bg-secondary rounded-5 p-4" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center p-4">
                        <p class="text-muted">Tidak ada gambar tersedia untuk destinasi ini.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\GitHub\Travelin\resources\views/place-detail_v2.blade.php ENDPATH**/ ?>