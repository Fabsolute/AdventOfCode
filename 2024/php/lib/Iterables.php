<?php

/**
 * This file is part of Boozt Platform
 * and belongs to Boozt Fashion AB.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

readonly class Iterables
{
    public static function map(iterable $values, callable $mapper): iterable
    {
        foreach ($values as $value) {
            yield $mapper($value);
        }
    }

    public static function filter(iterable $values, callable $predicate): iterable
    {
        foreach ($values as $value) {
            if ($predicate($value)) {
                yield $value;
            }
        }
    }

    public static function sort(array $values): array
    {
        sort($values);

        return $values;
    }

    public static function sum(iterable $values): int | float
    {
        return self::reduce($values, 0, static fn(float | int $v, float | int $o) => $o + $v);
    }

    public static function reduce(iterable $values, mixed $initial, callable $reducer): mixed
    {
        foreach ($values as $value) {
            $initial = $reducer($value, $initial);
        }

        return $initial;
    }

    public static function unzip(iterable $values): array
    {
        return self::reduce($values, [[], []], static function (iterable $values, array $lists) {
            $lists[0][] = $values[0];
            $lists[1][] = $values[1];

            return $lists;
        });
    }

    public static function collect(iterable $values): array
    {
        return iterator_to_array($values);
    }

    public static function zip(iterable $values1, iterable $values2): iterable
    {
        $multipleIterator = new MultipleIterator(MultipleIterator::MIT_NEED_ALL);
        $multipleIterator->attachIterator(self::toIterator($values1));
        $multipleIterator->attachIterator(self::toIterator($values2));

        return $multipleIterator;
    }

    public static function count(iterable $values, ?callable $predicate = null): int
    {
        return self::reduce($values, 0, static fn(mixed $x, int $o) => $o + ($predicate($x) ? 1 : 0));
    }

    public static function reverse(iterable $values): iterable
    {
        $values = array_reverse(iterator_to_array($values));
        foreach ($values as $value) {
            yield $value;
        }
    }

    private static function toIterator(iterable $values): Iterator
    {
        if ($values instanceof Iterator) {
            return $values;
        }

        if (is_array($values)) {
            return new ArrayIterator($values);
        }

        if ($values instanceof Traversable) {
            return new IteratorIterator($values);
        }

        throw new InvalidArgumentException('How did you get here?');
    }

    public static function chunkEvery(iterable $values, int $count, int $step): iterable
    {
        $output = [];
        $prevs = [];
        foreach ($values as $value) {
            if (count($output) === $count) {
                yield $output;
                $output = $prevs;
                $prevs = [];
            }

            $output[] = $value;
            if (count($output) > $step) {
                $prevs[] = $value;
            }
        }

        if (count($output) === $count) {
            yield $output;
        }
    }

    public static function all(iterable $values, callable $predicate): bool
    {
        foreach ($values as $value) {
            if (!$predicate($value)) {
                return false;
            }
        }

        return true;
    }

    public static function any(iterable $values, callable $predicate): bool
    {
        foreach ($values as $value) {
            if ($predicate($value)) {
                return true;
            }
        }

        return false;
    }

    public static function withIndex(iterable $values): iterable
    {
        $i = 0;
        foreach ($values as $value) {
            yield [$i, $value];
            $i++;
        }
    }

    public static function removeAt(array $values, int $index): array
    {
        unset($values[$index]);

        return array_values($values);
    }

    public static function product(iterable $values): float | int
    {
        return self::reduce($values, 1, fn(int | float $v, int | float $o) => $v * $o);
    }

    public static function first(iterable $values): mixed
    {
        foreach ($values as $value) {
            return $value;
        }

        throw new OutOfBoundsException();
    }
}
