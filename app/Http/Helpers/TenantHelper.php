<?php

namespace App\Http\Helpers;

use App\Tenant;
use Illuminate\Http\Request;
use Spatie\Multitenancy\TenantFinder\TenantFinder;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;

class TenantHelper extends TenantFinder
{
    use UsesTenantModel;

    public function findForRequest(Request $request): ?Tenant
    {
        $host = $request->getHost();

        return $this->getTenantModel()::whereDomain($host)->first();
    }
    public function findTenant($domain): ?Tenant
    {

        return $this->getTenantModel()::whereDomain($domain)->first();
    }
}
