<?php

/**
 * This file is part of Boozt Platform
 * and belongs to Boozt Fashion AB.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

readonly class Debug
{
    public static function dump(mixed $value): mixed
    {
        if ($value instanceof Traversable) {
            $value = iterator_to_array($value);
        }

        var_dump($value);

        return $value;
    }
}
