<?php $__empty_1 = true; $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                <a class="custom-button text-dark" href="<?php echo e(route('place.detail_v2', ['placeId' => $place['id']])); ?>">
                    <i class="fas fa-paper-plane pe-2"></i> Lihat
                </a>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="m-0 py-3 px-2">
        <div class="alert alert-warning text-center shadow-sm" role="alert">
            Tidak ada hasil yang ditemukan.
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\ASUS\Documents\GitHub\Travelin\resources\views/components/search-results.blade.php ENDPATH**/ ?>