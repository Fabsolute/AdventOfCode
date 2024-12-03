<?php

/**
 * This file is part of Boozt Platform
 * and belongs to Boozt Fashion AB.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

readonly class Reader
{
    public function __construct(private string $path)
    {
    }

    public static function CreateFromArgv(): self
    {
        $argv = $_SERVER['argv'];
        return new self($argv[1]);
    }

    public function read(): iterable
    {
        $handle = fopen($this->path, "r");
        if (!$handle) {
            throw new InvalidArgumentException("Unable to open file '{$this->path}'");
        }

        while (($line = fgets($handle)) !== false) {
            yield $line;
        }

        fclose($handle);
    }
}
