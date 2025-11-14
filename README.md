# Laravel Sluggable Redirect

**Laravel Sluggable Redirect** creates sluggable history and redirects to current slug. Compatible with [spatie/laravel-sluggable](https://github.com/spatie/laravel-sluggable) and [cviebrock/eloquent-sluggable](https://github.com/cviebrock/eloquent-sluggable). Originally [created](https://github.com/vanderb/laravel-sluggable-redirect) by [Freerk van Zeijl](https://github.com/vanderb), updated by [Viacheslav Radionov](https://github.com/Slaver).

## Setup

### Install

`composer require vanderb/laravel-sluggable-redirect`

### Migrate

Run `php artisan migrate` to migrate the sluggable-redirects table.

## Implement Traits

Implement *SluggableRedirectModel* to model, where you implemented sluggable package.

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
// or use Cviebrock\EloquentSluggable\Sluggable;

use Vanderb\SluggableRedirect\Traits\SluggableRedirectModel;

class YourModel extends Modal {

    use HasSlug;
	// or use Sluggable;
	use SluggableRedirectModel;

...
```

Implement *SluggableRedirectHandler* to your controller which handles the model in frontend

```php
use Vanderb\SluggableRedirect\Traits\SluggableRedirectHandler;

class YourController extends Controller {

    use SluggableRedirectHandler;
    
}
```

Call the checkSlug-method where you want to check the slug (maybe in show-method):

Parameters:
- $slug = the slug given by method
- $model = model responsable for your slugs, implemted by dependency injection
- callback (do what you normally do in your show method e.g. return view etc.)

```php
public function show($slug, Model $model) {
    return $this->checkSlug($slug, $model, function($event) {
        return view('my-view');
    }
}
```

## Notes

Please note, this package is not in stable mode. There are many methods and functions which can be solved better.
If you have any suggestions for that, feel free to make an issue or request. Thank you.
