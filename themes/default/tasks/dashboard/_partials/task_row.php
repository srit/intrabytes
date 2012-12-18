<?php
/**
 * @created 23.11.12 - 13:01
 * @author stefanriedel
 */
?>

<p>
    <span class="label label-important"
          style="background-color: <?php echo e($task->task_category->background_color) ?>; color: <?php echo e($task->task_category->color) ?>"><?php echo e($task->task_category->name) ?></span>
    <?php echo \Date::create_from_string($task->due_date, 'mysql')->format('de_normal'); ?> -
    <strong><?php echo e($task->title) ?></strong>
</p>