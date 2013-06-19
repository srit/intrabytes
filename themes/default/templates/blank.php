<?php
// page header
echo $theme->view('templates/header', array('title' => $title, 'additional_js' => $additional_js), false);
echo $theme->view('templates/_partials/body/start');
echo $theme->view('templates/_partials/body/start_blank');
?>

                    <legend><?php echo $title ?></legend>

                    <?php
                    foreach (array('error', 'warning', 'success', 'info') as $type) {
                        foreach (\Messages::instance()->get($type) as $message) {
                            echo '<div class="alert alert-', $message['type'], '"><a class="close" data-dismiss="alert" href="#">×</a>', $message['body'], '</div>', "\n";
                        }
                    }
                    \Messages::reset();
                    ?>

                    <?php echo $partials['content']; ?>

<?php
echo $theme->view('templates/_partials/body/end_blank');
echo $theme->view('templates/_partials/body/end', array('additional_js' => $additional_js), false)
?>