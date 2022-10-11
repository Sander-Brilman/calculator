<?php

$timer = start_timer();
$unit_tests = [];

require_once('assets/php/load_files.php');

include_files('unit_tests');

$html = '';
$results = [
    'total' => 0,
    'successes' => 0,
    'fails' => 0,
    'exceptions' => 0,
    'errors' => 0,
];

run_unit_tests_array($unit_tests, 'All tests', 0, $html, $results);

function run_unit_tests_array($array, $group_name, $indent_level, &$html, &$results)
{
    $indent_style = 'style="margin-left: '.(40 * $indent_level).'px;"';
    $html .= '<h4 class="pt-2" '.$indent_style.'>- '.$group_name.'</h4>';
    foreach ($array as $index => $unit_test) {

        if (is_array($unit_test)) {
            run_unit_tests_array($unit_test, $group_name . ' -> ' . $index, $indent_level + 1, $html, $results);
        }

        if (!($unit_test instanceof unit_test)) {
            continue;
        }
        $results['total']++;
    
        $alert_type = '';
        $message = '';
        try {
            $result = $unit_test->run_test();
            if ($result instanceof test_result) {
                $alert_type = $result->success ? 'success' : 'danger';
                $results[$result->success ? 'successes' : 'fails']++;
                $message = $result->message;
            }
        } catch(Exception $ex) {
            $results['exceptions']++;
            $alert_type = 'info';
            $message = 'Exception thrown: '.$ex->getMessage();
        } catch(Error $er) {
            $results['errors']++;
            $alert_type = 'warning';
            $message = 'Error: '.$er->getMessage();
        }
        $html .= '
        <div class="mb-0 alert alert-'. $alert_type .'"'. $indent_style .'>
            <span class="me-4 fw-bold lead">'. $unit_test->test_name .':</span>
            <span>'. $message .'</span>
        </div>';
    }
}

?>

<div class="alert alert-info rounded-0 test-info">
    <span class="lead fw-bold">Results - <?= end_timer($timer) ?> ms</span>
    <hr>
    <div id="total" style="cursor: pointer;">
        <span class="fw-bold text-primary">Total tests</span>
        <span><?= $results['total'] ?></span>
    </div>
    <div data-search="success" style="cursor: pointer;">
        <span class="fw-bold text-success">Succeeded</span>
        <span><?= $results['successes'] ?></span>
    </div>
    <div data-search="danger" style="cursor: pointer;">
        <span class="fw-bold text-danger">Fails</span>
        <span><?= $results['fails'] ?></span>
    </div>
    <div data-search="info" style="cursor: pointer;">
        <span class="fw-bold text-info">Exceptions</span>
        <span><?= $results['exceptions'] ?></span>
    </div>
    <div data-search="warning" style="cursor: pointer;">
        <span class="fw-bold text-warning">Errors</span>
        <span><?= $results['errors'] ?></span>
    </div>
</div>

<?php

if (($results['fails'] + $results['errors'] + $results['exceptions']) > 0) {
    ?>
    <div class="alert alert-danger lead fw-bold">
        There are failed unit tests
    </div>
    <?php
}

?>

<?= $html ?>

<script>
    $('.test-info > div:not(#total)').click(function() {
        let search = $(this).attr('data-search');
        console.log('testing', search);

        $('.alert:not(.test-info)').each(function() {
            $(this).hasClass(`alert-${search}`)
                ? $(this).show(500)
                : $(this).hide(500);
        })
    })

    $('#total').click(function() {
        $('.alert').show(500);
    })
</script>