<?php
$xml = simplexml_load_file('calcai.xml');

foreach ($xml->function as $function) {
    $functionName = (string) $function->function_name;
    $functionURL = (string) $function->function_URL;

    echo '<form action="' . $functionURL . '" method="get">';
    echo '<h3>' . $functionName . '</h3>';

    foreach ($function->parameters->param as $param) {
        $paramName = (string) $param->name;
        $paramDefault = (string) $param->default;

        echo '<div>' . htmlspecialchars($paramName) . ': ';
        echo '<input type="text" name="' . htmlspecialchars($paramName) . '" value="' . htmlspecialchars($paramDefault) . '" size="30">';
        echo '</div>';
    }

    echo '<div><input type="submit" value="Submit"></div>';
    echo '</form><br>';
}
?>
