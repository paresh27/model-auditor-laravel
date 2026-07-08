# Model Auditor for Laravel

Laravel integration for [paresh27/model-auditor](https://github.com/paresh27/model-auditor) — automatically audit Eloquent model changes.

## Installation

```bash
composer require paresh27/model-auditor-laravel
php artisan model-auditor:install
```

## Usage

```php
use Paresh27\ModelAuditorLaravel\Concerns\Auditable;

class Post extends Model
{
    use Auditable;
}
```

Every create, update, and delete on `Post` is now automatically recorded.

## Testing

```bash
composer test
```

## License

MIT