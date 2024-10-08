<?php

declare(strict_types=1);

it('calculates average reading time', function (): void {

    $text = implode(' ', array_fill(0, 1000, 'word'));

    expect(reading_time($text))->toBe('4m');
});

it('calculates slow reading time', function (): void {

    $text = implode(' ', array_fill(0, 1000, 'word'));

    expect(reading_time()->slow($text))->toBe('5m');
});

it('calculates fast reading time', function (): void {

    $text = implode(' ', array_fill(0, 1000, 'word'));

    expect(reading_time()->fast($text))->toBe('3m');
});

it('can be configured locally', function (): void {

    $text = implode(' ', array_fill(0, 1000, 'word'));

    expect(reading_time(config: ['fastWpm' => 400])->fast($text))->toBe('2m')
        ->and(reading_time()->fast($text))->toBe('3m');
});

it('can be configured globally', function (): void {

    $text = implode(' ', array_fill(0, 1000, 'word'));

    expect(reading_time()->configure(['fastWpm' => 400], true)->fast($text))->toBe('2m')
        ->and(reading_time()->fast($text))->toBe('2m');
});

it('calculates average reading time with seconds', function (): void {

    $text = implode(' ', array_fill(0, 1000, 'word'));

    expect(reading_time($text, ['seconds' => true]))->toBe('4m 10s');
});

it('calculates average reading time long form', function (): void {

    $text = implode(' ', array_fill(0, 1000, 'word'));

    expect(reading_time($text, [
        'seconds' => true,
        'short' => false,
    ]))->toBe('4 minutes 10 seconds');
});

it('return null if less than a min', function (): void {

    $text = implode(' ', array_fill(0, 200, 'word'));

    expect(reading_time($text))->toBeNull();
});

it('return only seconds if less than a min', function (): void {

    $text = implode(' ', array_fill(0, 200, 'word'));

    expect(reading_time($text, ['seconds' => true]))->toBe('50s');
});

it('calculates average without html', function (): void {

    $text = implode(' ', array_fill(0, 500, '<span>word</span>'));

    expect(reading_time($text, [
        'seconds' => true,
        'short' => false,
    ]))->toBe('2 minutes 5 seconds');
});

it('calculates average with html', function (): void {

    $text = implode(' ', array_fill(0, 500, '<span>word</span>'));

    expect(reading_time($text, [
        'seconds' => true,
        'short' => false,
        'countHtml' => true,
    ]))->toBe('6 minutes 15 seconds');
});
