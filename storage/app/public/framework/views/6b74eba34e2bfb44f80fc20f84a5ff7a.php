<?php $__env->startPush('styles'); ?>
    <style>
        .custom-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            background: #fff;
            width: 100%;
            height: 400px;
        }

        .custom-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .category-section {
            margin-bottom: 3rem;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 1rem;
        }

        .category-title {
            color: #333;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #8dd3bb;
            display: inline-block;
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
        }

        .custom-button:hover {
            background-color: #92c4b8;
        }

        .custom-button i {
            margin-right: 5px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <h3 class="mb-5 fw-bold">All Recommendations</h3>

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $places): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="category-section">
                <h4 class="category-title"><?php echo e($category); ?></h4>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="custom-card">
                                <?php if($place['photo_url']): ?>
                                    <img src="<?php echo e($place['photo_url']); ?>" alt="<?php echo e($place['name']); ?>">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/placeholder.png')); ?>" alt="Placeholder Image">
                                <?php endif; ?>
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\GitHub\Travelin\resources\views/recommendations.blade.php ENDPATH**/ ?>