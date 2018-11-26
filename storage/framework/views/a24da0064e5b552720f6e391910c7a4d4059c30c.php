<?php if($paginator->hasPages()): ?>
        
        <?php if($paginator->onFirstPage()): ?>
            <a class="disabled"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <?php endif; ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        <?php else: ?>
            <a class="disabled"><span class="glyphicon glyphicon-chevron-right"></span></a>
        <?php endif; ?>
<?php endif; ?>