# Laravel playSMS Notification Channel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coreproc/laravel-notification-channel-play-sms.svg?style=flat-square)](https://packagist.org/packages/coreproc/laravel-notification-channel-play-sms)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://styleci.io/repos/:style_ci_id/shield)](https://styleci.io/repos/:style_ci_id)
[![Quality Score](https://img.shields.io/scrutinizer/g/coreproc/laravel-notification-channel-play-sms.svg?style=flat-square)](https://scrutinizer-ci.com/g/coreproc/laravel-notification-channel-play-sms)
[![Total Downloads](https://img.shields.io/packagist/dt/coreproc/laravel-notification-channel-play-sms.svg?style=flat-square)](https://packagist.org/packages/coreproc/laravel-notification-channel-play-sms)

This package makes it easy to send notifications using [playSMS](https://playsms.org) with Laravel 5.5+ and 6.0

## Contents

- [Installation](#installation)
	- [Setting up the playSMS service](#setting-up-the-playSMS-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

Install this package with Composer:

    composer require coreproc/laravel-notification-channel-playsms

### Setting up the playSMS service

A web server with playSMS installed is required to use this service. Visit 
[https://help.playsms.org/en/](https://help.playsms.org/en/) to check out set up / installation instruction for playSMS.

Once you have a playSMS server up and running, you can obtain an API key by going to `My Account` -> 
`User Configuration`. You'll be able to see your webservices token in that page. Use this as your API key.  

Add the base URL of your playSMS server, your username, and your API key to your `config/services.php`.

    // config/services.php
    ....
    'playsms' => [
        'base_url' => env('PLAYSMS_BASE_URL'),
        'username' => env('PLAYSMS_USERNAME'),
        'api_key' => env('PLAYSMS_API_KEY'),
    ],
    ...

## Usage

Sending a playSMS notification can be done by making a `Notification` class with the following:

```php
use CoreProc\NotificationChannels\PlaySms\PlaySmsChannel;
use CoreProc\NotificationChannels\PlaySms\PlaySmsMessage;
use Illuminate\Notifications\Notification;

class AccountActivated extends Notification
{
    public function via($notifiable)
    {
        return [PlaySmsChannel::class];
    }

    public function toPlaySms($notifiable)
    {
        return (new PlaySmsMessage())->setMessage('Your account has been activated!');
    }
}
```

### Available Message methods

The `PlaySmsMessage` has only one method available as of now:

```php
setMessage($message)
```

Use this method to set the content of the SMS being sent.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email ask@coreproc.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [CoreProc](https://github.com/CoreProc)
- [All Contributors](../../contributors)

## About CoreProc, Inc.

CoreProc, Inc. is a software development company that provides software development services to startups, digital/ad agencies, and enterprises.

Learn more about us on our [website](https://coreproc.com).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
