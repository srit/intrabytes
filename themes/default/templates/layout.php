<?php
// page header
echo $theme->view('templates/header');
echo $theme->view('templates/_partials/body/start');
echo $partials['navigation'];
//echo $theme->view('templates/navbar', array('top_left' => $top_left, 'top_right' => $top_right));
?>
<div class="container" id="content">
    <div id="page-container">

        <?php echo h4($title); ?>
        <div class="row-fluid">
            <div class="span9"><?php echo $partials['breadcrumb'] ?></div>
            <div class="span3"><?php echo $partials['last_pages'] ?></div>
        </div>
        <div class="row-fluid show-grid">
            <div class="span12 content">
                <?php
                if (\Srit\Messages::instance()) {
                    $messages = false;
                    foreach (array('error', 'warning', 'success', 'info') as $type) {
                        foreach (\Srit\Messages::instance()->get($type) as $message) {
                            $messages = true;
                            echo '<div class="alert alert-', $message['type'], '"><a class="close" data-dismiss="alert" href="#">×</a>', $message['body'], '</div>', "\n";
                        }
                    }
                }
                \Srit\Messages::reset();
                if ($messages == true) {
                    echo html_tag('div', array('class' => 'clearfix'));
                }
                ?>
                <?php echo $partials['content']; ?>
            </div>
        </div>
    </div>
</div>
<?php echo $theme->view('templates/_partials/body/end') ?>

