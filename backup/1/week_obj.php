<?php 
function getWeeksOfMonth(string $data): array
{
    $arrayOfWeeks = [];

    $period = new DatePeriod(
        DateTime::createFromFormat('!Y-n-d', $data),
        new DateInterval('P1D'),
        DateTime::createFromFormat('!Y-n-d', $data)->add(new DateInterval('P1M'))
    );

    foreach ($period as $weeks) {
        $arrayOfWeeks[$weeks->format('W')][] = $weeks;
    }

    $arrOfDays = function($stack): array {
        foreach ($stack as $w => $date) {
            $base[] = range($date[0]->format('d'), $date[count($date)-1]->format('d'));
        }
        return $base;
    };

    return $arrOfDays($arrayOfWeeks);
}

foreach (getWeeksOfMonth('2020-12-01') as $k => $v) {
    echo $k . " неделя: ";
    echo join(', ', $v) . PHP_EOL;
    echo "<br>";
}

foreach (getWeeksOfMonth('2021-01-01') as $k => $v) {
    echo $k . " неделя: ";
    echo join(', ', $v) . PHP_EOL;
    echo "<br>";
}
echo "<br>";
$a=date("Y-m-d-H-i-s");
echo $a;

echo "<br>";
echo "<br>";

$b=date("Y-m-d");
echo $b;
// "<pre>"
// var_dump(getWeeksOfMonth('2020-12-01'));
// "</pre>"

// "<pre>"
// var_dump($arrOfDays);
// "</pre>"
 ?>