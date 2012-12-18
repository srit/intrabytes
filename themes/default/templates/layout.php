<?php
// page header
echo $theme->view('templates/header');
echo $theme->view('templates/_partials/body/start');
echo $theme->view('templates/navbar');
?>
<div class="container">
    <?php
    foreach (array('error', 'warning', 'success', 'info') as $type) {
        foreach (\Core\Messages::instance()->get($type) as $message) {
            echo '<div class="alert alert-', $message['type'], '"><a class="close" data-dismiss="alert" href="#">×</a>', $message['body'], '</div>', "\n";
        }
    }
    \Core\Messages::reset();
    ?>
    <div id="page-container"><?php echo $partials['content']; ?></div>
</div>