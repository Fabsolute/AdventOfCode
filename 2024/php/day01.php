<?php

require_once "lib/load.php";

class HistorianHysteria
{
    public static function diff(array $values): iterable
    {
        [$list1, $list2] = $values;
        $list1 = Iterables::sort($list1);
        $list2 = Iterables::sort($list2);

        return Iterables::map(
            Iterables::zip($list1, $list2),
            static fn(array $values) => abs($values[0] - $values[1]),
        );
    }

    public static function similarity(array $values): iterable
    {
        [$list1, $list2] = $values;

        return Iterables::map(
            $list1,
            static fn(int $value) => $value * Iterables::count($list2, static fn($x) => $x === $value),
        );
    }
}

$lines = Reader::CreateFromArgv()->read();
$values = Iterables::unzip(
    Iterables::map(
        $lines,
        static function (string $line) {
            return Iterables::collect(Iterables::map(Strings::split($line, ' ', trim: true), Strings::toInt(...)));
        }
    )
);

echo "Part1: ";
echo Iterables::sum(
    HistorianHysteria::diff($values),
);
echo "\n";

echo "Part2: ";
echo Iterables::sum(
    HistorianHysteria::similarity($values),
);
echo "\n";
