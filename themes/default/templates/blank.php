<?php
// page header
echo $theme->view('templates/header');
echo $theme->view('templates/_partials/body/start');
?>
<div class="container">
    <div id="content">
        <section id="section_login">
            <div class="row">
                <div class="span4 offset4 well">
                    <legend><?php echo $title ?></legend>

                    <?php
                    foreach (array('error', 'warning', 'success', 'info') as $type) {
                        foreach (\Srit\Messages::instance()->get($type) as $message) {
                            echo '<div class="alert alert-', $message['type'], '"><a class="close" data-dismiss="alert" href="#">×</a>', $message['body'], '</div>', "\n";
                        }
                    }
                    \Srit\Messages::reset();
                    ?>

                    <?php echo $partials['content']; ?>
                </div>
            </div>
        </section>
    </div>
</div>
<?php echo $theme->view('templates/_partials/body/end') ?>