<?php

/**
 * This file is part of Boozt Platform
 * and belongs to Boozt Fashion AB.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

class Regex
{
    public static function scan(string $pattern, string $values): array
    {
        if (!preg_match_all($pattern, $values, $out, PREG_SET_ORDER)) {
            throw new InvalidArgumentException(preg_last_error_msg());
        }

        return $out;
    }
}
