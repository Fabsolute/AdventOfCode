<?php

require_once "lib/load.php";

class MullItOver
{
    public static function normalize(string $values): iterable
    {
        return Iterables::map(
            Regex::scan("#mul\((\d+,\d+)\)|(do)\(\)|(don't)\(\)#", $values),
            static function (array $value) {
                return match (count($value)) {
                    2 => [
                        Iterables::product(
                            Iterables::map(
                                Strings::split($value[1], ',', trim: true),
                                Strings::toInt(...),
                            ),
                        ),
                        null,
                        null,
                    ],
                    3 => [
                        0,
                        true,
                        null,
                    ],
                    4 => [
                        0,
                        null,
                        true,
                    ],
                };
            },
        );
    }

    public static function mul1(iterable $values): int
    {
        return Iterables::sum(
            Iterables::map(
                $values,
                Iterables::first(...),
            ),
        );
    }

    public static function mul2(iterable $values): int
    {
        return Iterables::first(
            Iterables::reduce(
                $values,
                [0, true],
                static function (array $instruction, array $carry) {
                    [$x, $enable, $disable] = $instruction;
                    [$acc, $enabled] = $carry;
                    if ($enable) {
                        return [$acc, true];
                    }

                    if ($disable) {
                        return [$acc, false];
                    }

                    if ($enabled) {
                        return [$acc + $x, true];
                    }

                    return [$acc, false];
                },
            ),
        );
    }
}

$lines = Reader::CreateFromArgv()->read();
$values = Strings::join(
    Iterables::collect($lines),
);

echo "Part1: ";
echo MullItOver::mul1(
    MullItOver::normalize(
        $values,
    ),
);
echo "\n";

echo "Part2: ";
echo MullItOver::mul2(
    MullItOver::normalize(
        $values,
    ),
);
echo "\n";
