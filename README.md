# Honeystone Reading Time

![Static Badge](https://img.shields.io/badge/tests-passing-green)
![GitHub License](https://img.shields.io/github/license/honeystone/reading-time)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/honeystone/reading-time)](https://packagist.org/packages/honeystone/reading-time)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/honeystone/reading-time/php)
[![Static Badge](https://img.shields.io/badge/honeystone-fa6900)](https://honeystone.com)

Use this very simple reading time package to calculate the expected reading time for any given body of text.

## Support us

[![Support Us](https://honeystone.com/images/github/support-us.webp)](https://honeystone.com)

We are committed to delivering high-quality open source packages maintained by the team at Honeystone. If you would
like to support our efforts, simply use our packages, recommend them and contribute.

If you need any help with your project, or require any custom development, please [get in touch](https://honeystone.com/contact-us).

## Installation

```shell
composer require honeystone/reading-time
```

## Usage

```php
//average reading time
reading_time($text); //5m

//fast reading time
reading_time()->fast($text) //4m

//slow reading time
reading_time()->slow($text) //6m

//include seconds
reading_time(config: ['seconds' => true]); //5m 10s

//longform
reading_time(config: ['short' => false]); //5 minutes

//configure globally
reading_time()->configure(['short' -> false], true);

//all available config & defaults
reading_time()->configure([
    'slowWpm' => 180,
    'averageWpm' => 240,
    'fastWpm' => 320,
    'additionalCharacters' => '',
    'seconds' => false,
    'format' => null,
    'short' => true,
    'countHtml' => false,
]);
```

## Changelog

A list of changes can be found in the [CHANGELOG.md](CHANGELOG.md) file.

## License

[MIT](LICENSE.md) © [Honeystone Consulting Ltd](https://honeystone.com)
