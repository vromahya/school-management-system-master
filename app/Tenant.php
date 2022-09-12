<?php

namespace App;

use mysqli;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends BaseTenant
{
    use UsesLandlordConnection, UsesTenantModel;

    protected $fillable = [
        'name',
        'domain',
        'database'
    ];
    protected $hidden = ['database'];
    public static function booted()
    {
        // static::creating(fn (Tenant $model) => $model->createDatabase());
    }
}
