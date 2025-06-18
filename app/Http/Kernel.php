<?php
namespace App\Http;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
 /**
  * Create a new HTTP kernel instance.
  */
 public function __construct(Application $app, \Illuminate\Contracts\Http\Kernel $kernel)
 {
  parent::__construct($app, $kernel);

  $this->appendMiddlewareToGroup('web', [
   // Optional: web middleware গুলো এখানে
  ]);

  $this->appendMiddlewareToGroup('api', [
   \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
   'throttle:api',
   \Illuminate\Routing\Middleware\SubstituteBindings::class,
  ]);
 }
}
