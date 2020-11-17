<?php 
if (! function_exists('thousandsCurrencyFormat')) {
    function thousandsCurrencyFormat($num)
    {
        if($num>1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('K', 'M', 'B', 'T');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
        }
        return $num;
    }
}
if (! function_exists('minutesConverter')) {
function minutesConverter($from) {
    if (!$from) return '0 minutes';
    $periods = array('year' => 525600,
                     'month' => 43800,
                     'week' => 10080,
                     'day' => 1440,
                     'hour' => 60,
                     'minute' => 1);
    $output = array();
    foreach ($periods as $period_name => $period) {
        $num_periods = floor($from / $period);
        if ($num_periods > 1) {
            $output[] = "$num_periods {$period_name}s";
        }
        elseif ($num_periods > 0) {
            $output[] = "$num_periods {$period_name}";
        }
        $from -= $num_periods * $period;
    }
    return implode(' : ', $output);
}
}