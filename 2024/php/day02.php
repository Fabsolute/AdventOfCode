<?php

require_once "lib/load.php";

class RedNosedReport
{
    public static function safe1(array $values): bool
    {
        [$first, $second] = $values;
        if ($first < $second) {
            $values = Iterables::reverse($values);
        }

        return !Iterables::any(
            Iterables::chunkEvery(
                $values,
                2,
                1,
            ),
            fn(array $val) => $val[0] - $val[1] <= 0 || $val[0] - $val[1] > 3,
        );
    }

    public static function safe2(array $values): bool
    {
        if (self::safe1($values)) {
            return true;
        }

        return Iterables::any(
            Iterables::collect(
                Iterables::map(
                    Iterables::withIndex($values),
                    function (array $value) use ($values) {
                        return Iterables::removeAt($values, $value[0]);
                    }
                ),
            ),
            self::safe1(...),
        );
    }
}

$lines = Reader::CreateFromArgv()->read();
$values = Iterables::collect(
    Iterables::map(
        $lines,
        static function (string $line) {
            return Iterables::collect(Iterables::map(Strings::split($line, ' ', trim: true), Strings::toInt(...)));
        }
    )
);

echo "Part1: ";
echo Iterables::count(
    $values,
    RedNosedReport::safe1(...),
);
echo "\n";

echo "Part2: ";
echo Iterables::count(
    $values,
    RedNosedReport::safe2(...),
);
echo "\n";
