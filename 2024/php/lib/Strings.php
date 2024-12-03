<?php

/**
 * This file is part of Boozt Platform
 * and belongs to Boozt Fashion AB.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

readonly class Strings
{
    public static function split(string $text, string $separator, bool $trim = false, bool $noEmpty = true): iterable
    {
        $parts = explode($separator, $text);
        if ($trim) {
            $parts = Iterables::map($parts, trim(...));
        }

        if ($noEmpty) {
            $parts = Iterables::filter($parts, self::notEmpty(...));
        }

        return $parts;
    }

    public static function toInt(string $value): int
    {
        return (int) $value;
    }

    public static function notEmpty(string $value): bool
    {
        return !empty($value);
    }

    public static function join(array $values, string $separator = ''): string
    {
        return implode($separator, $values);
    }
}
