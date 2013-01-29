<?php
// page header
echo $theme->view('templates/header');
echo $theme->view('templates/_partials/body/start');
echo $theme->view('templates/navbar');
?>
<div class="container">
    <div id="page-container">
        <legend><?php echo $title ?></legend>
        <div class="row-fluid show-grid">
            <div class="span12 content">
                <?php
                foreach (array('error', 'warning', 'success', 'info') as $type) {
                    foreach (\Core\Messages::instance()->get($type) as $message) {
                        echo '<div class="alert alert-', $message['type'], '"><a class="close" data-dismiss="alert" href="#">×</a>', $message['body'], '</div>', "\n";
                    }
                }
                \Core\Messages::reset();
                ?>
                <?php echo $partials['content']; ?>
            </div>
        </div>
    </div>
</div>