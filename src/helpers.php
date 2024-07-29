<?php

declare(strict_types=1);

use Honeystone\ReadingTime\Calculator;

if (!function_exists('reading_time')) {

    /**
     * @param array<string, mixed>|null $config
     */
    function reading_time(?string $text = null, ?array $config = null): Calculator|string|null
    {
        $calculator = new Calculator();

        if ($config !== null) {
            $calculator->configure($config);
        }

        return $text === null ? $calculator : $calculator->average($text);
    }
}
