<?php

namespace AlessandroBertozzi\Project\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Project\Database\Factories\ProjectFactory;
use Modules\CulturalObject\Models\CulturalObject;
use Modules\Project\Services\ProjectService;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Project extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    protected $guarded = ['id'];

    // protected $auditInclude = [
    //     'title',
    //     'description',
    //     'type',
    //     'status'
    // ];

    // protected $casts = [
    //     'active_modules' => 'array',
    // ];

    // public function activeModules(): array
    // {
    // }


    protected function projectTypeHuman(): Attribute
    {
        $modulesData = ProjectService::getProjectTypesSelectOptionsData();

        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $modulesData[$attributes['project_type']],
        )->shouldCache();
    }


    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }

    public function hasUser($user): bool
    {
        return $this->users->contains($user);
    }

    public function projectUsers(): HasMany
    {
        return $this->hasMany(\Modules\Project\Models\ProjectUser::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\User::class);
    }

    public function projectable(): MorphTo
    {
        return $this->morphTo();
    }

    public function culturalObjects()
    {
        return $this->hasMany(CulturalObject::class);
    }


}
