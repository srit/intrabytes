<?php
/**
 * @created 01.10.12 - 10:59
 * @author stefanriedel
 */?>
<body>
<!-- Begin messages -->
<?php
foreach (array('error', 'warning', 'success', 'info') as $type) {
    foreach (\Core\Messages::instance()->get($type) as $message) {
        echo '<div class="alert alert-', $message['type'], '">', $message['body'], '</div>', "\n";
    }

}
\Core\Messages::reset();
?>
<!-- End of messages -->