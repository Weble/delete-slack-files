# DeleteSlackFiles

Quick console command to delete slack files older than X days.
Written in PHP

## Install

Via Composer

``` bash
$ composer require webleit/delete-slack-files
```

## Usage

Follow this guide to generate a slack token: [https://get.slack.help/hc/en-us/articles/215770388-Create-and-regenerate-API-tokens](https://get.slack.help/hc/en-us/articles/215770388-Create-and-regenerate-API-tokens)

``` php
php console slack:deletefiles olderThanXDays --token=yourSlackToken
```

### Example

Delete files older than 1 year

``` php
php console slack:deletefiles 365 --token=dsjiadp2831312pnu8sdjafjp8128213jdsaopdj81
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email daniele@weble.it instead of using the issue tracker.

## Credits

- [Daniele Rosario - Weble Srl][https://www.weble.it]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/webleit/delete-slack-files.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/webleit/delete-slack-files/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/webleit/delete-slack-files.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/webleit/delete-slack-files
[link-contributors]: ../../contributors
