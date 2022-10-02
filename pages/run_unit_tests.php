<?php
$unit_tests = [];

require_once('assets/php/load_files.php');

include_files('unit_tests');


run_unit_tests_array($unit_tests, 'All tests');

function run_unit_tests_array($array, $group_name, $indent_level = 0)
{
    $indent_style = 'style="margin-left: '.(40 * $indent_level).'px;"';
    echo '<h4 class="pt-2" '.$indent_style.'>- '.$group_name.'</h4>';
    foreach ($array as $index => $unit_test) {

        if (is_array($unit_test)) {
            run_unit_tests_array($unit_test, $group_name . ' -> ' . $index, $indent_level + 1);
        }

        if (!($unit_test instanceof unit_test)) {
            continue;
        }
    
        $alert_type = '';
        $message = '';
        try {
            $result = $unit_test->run_test();
            if ($result instanceof test_result) {
                $alert_type = $result->success ? 'success' : 'danger';
                $message = $result->message;
            }
        } catch(Exception $ex) {
            $alert_type = 'warning';
            $message = 'Exception thrown: '.$ex->getMessage();
        } catch(Error $er) {
            $alert_type = 'danger';
            $message = 'Error: '.$er->getMessage();
        }
        ?>
        <div class="mb-0 alert alert-<?= $alert_type ?>" <?= $indent_style ?>>
            <span class="me-4 fw-bold lead"><?= $unit_test->test_name ?>:</span>
            <span><?= $message ?></span>
        </div>
        <?php
    }
}


?>