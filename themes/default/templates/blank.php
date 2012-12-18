<?php
// page header
echo $theme->view('templates/header');
?>
<div class="container">
    <div id="content">
        <section id="section_login">
            <div class="row">
                <div class="span4 offset4 well">
                    <legend><?php echo $title ?></legend>

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
        </section>
    </div>
</div>
<?php
// page footer
echo $theme->view('templates/footer');
?>