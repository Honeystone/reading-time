<?php

declare(strict_types=1);

namespace Honeystone\ReadingTime;

use Carbon\CarbonInterval;

use function array_merge;
use function floor;
use function str_word_count;
use function strip_tags;

final class Calculator
{
    /**
     * @var array<string, mixed>
     */
    private static array $config = [
        'slowWpm' => 180,
        'averageWpm' => 240,
        'fastWpm' => 320,
        'additionalCharacters' => '',
        'seconds' => false,
        'format' => null,
        'short' => true,
        'countHtml' => false,
    ];

    /**
     * @var array<string, mixed>
     */
    private array $localConfig;

    public function __construct()
    {
        $this->localConfig = self::$config;
    }

    /**
     * @param array<string, mixed> $config
     *
     * @return $this
     */
    public function configure(array $config, bool $global = false): self
    {
        if ($global) {
            self::$config = array_merge(self::$config, $config);
        }

        $this->localConfig = array_merge($this->localConfig, $config);

        return $this;
    }

    public function slow(string $text): ?string
    {
        return $this->toInterval($this->calculate($text, 'slow'));
    }

    public function average(string $text): ?string
    {
        return $this->toInterval($this->calculate($text));
    }

    public function fast(string $text): ?string
    {
        return $this->toInterval($this->calculate($text, 'fast'));
    }

    private function calculate(string $text, string $speed = 'average'): float
    {
        return ($this->countWords($text) / $this->localConfig[$speed.'Wpm']);
    }

    private function countWords(string $text): int
    {
        if (!$this->localConfig['countHtml']) {
            $text = strip_tags($text);
        }

        return str_word_count($text, 0, $this->localConfig['additionalCharacters']);
    }

    private function toInterval(float $mins): ?string
    {
        if (!$this->localConfig['seconds']) {

            $mins = floor($mins);

            if ($mins === 0.0) {
                return null;
            }
        }

        $interval = CarbonInterval::seconds($mins * CarbonInterval::getSecondsPerMinute());

        if ($this->localConfig['format'] !== null) {
            return $interval->format($this->localConfig['format']);
        }

        return $interval->cascade()->forHumans(short: $this->localConfig['short']);
    }
}
