<?php

declare(strict_types=1);

namespace Vanderb\SluggableRedirect\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Vanderb\SluggableRedirect\Models\SluggableRedirect;

trait SluggableRedirectModel
{
    protected static function bootSluggableRedirectModel(): void
    {
        static::updating(function (Model $model): void {
            if (! $model->isDirty('slug')) {
                return;
            }

            $originalSlug = (string) $model->getOriginal('slug', '');

            if ($originalSlug === '') {
                return;
            }

            $model->sluggableRedirects()->create([
                'slug' => $originalSlug,
            ]);
        });

        static::deleting(function (Model $model): void {
            $model->sluggableRedirects()->delete();
        });
    }

    public function sluggableRedirects(): MorphMany
    {
        return $this->morphMany(SluggableRedirect::class, 'sluggable');
    }
}
