<?php

function dump($data): void
{
    /**
     * Prints value in a readable pop-up.
     * Prints additional info about where it was called.
     * 
     * Used for debugging
     * 
     * @param mixed the value to be dumped
     * 
     * @return void
     */
    $caller = debug_backtrace();
    $caller = array_pop($caller);
    $style  = 'z-index: 9999; border: red solid 2px; background: white;';
    ?>
    <div style="<?= $style ?>">
        <p>
            Called from: 
            <?php 
            echo '<b>'.$caller["file"].'</b>'; 
            echo ($caller["function"] != 'dump' ? 'from '.$caller["function"] : ''). ' ';
            echo 'on line <b>'.$caller["line"].'</b>';
            ?>
        </p>
        <pre>
            <?php
            var_dump($data);
            ?>
        </pre>
    </div>
    <?php
}
?>