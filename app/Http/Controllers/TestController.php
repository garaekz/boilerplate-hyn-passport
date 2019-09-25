<?php

namespace App\Http\Controllers;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;
use Illuminate\Support\Facades\Artisan;
use Hyn\Tenancy\Environment;
use Illuminate\Http\Request;
use App\Tenant\Models\User;

class TestController extends Controller
{
    public function tenant()
    {
        $website = new Website;
        app(WebsiteRepository::class)->create($website);
        $hostname = new Hostname;
        $hostname->fqdn = 'dobby.pyke.local';
        $hostname = app(HostnameRepository::class)->create($hostname);
        app(HostnameRepository::class)->attach($hostname, $website);

        $tenancy = app(Environment::class);

        $tenancy->hostname($hostname);
        $tenancy->hostname();
        $tenancy->tenant($website);

        Artisan::call('tenancy:run', [
            'run' => 'passport:install',
            '--tenant' => [$tenancy->tenant()->id]
            ]);
        dd($tenancy->tenant());
    }
}
