<?php
/**
 * @created 30.09.12 - 20:52
 * @author stefanriedel
 */
?>

<?php

if (is_array($dashboard_items) && count($dashboard_items) > 0) {

    foreach ($dashboard_items as $i => $item) {
        echo '<div id="item-' . $i . '">' . $item . '</div>';
    }
}

?>
