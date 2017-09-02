<?php

namespace OwenMelbz\DomainEnforcement;

use Closure;

class DomainEnforcementAgency {

    private static $except = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('domain_enforcement.enforce_domain') === true) {

            $accessedUrl = $request->root();
            $definedUrl = config('app.url');

            if (empty($definedUrl) || $definedUrl === '/') {
                $definedUrl = config('domain_enforcement.url');
            }

            if ($accessedUrl !== $definedUrl && !$this->inExceptArray($request)) {
                return redirect($definedUrl . $request->getRequestUri());
            }
        }

        return $next($request);
    }

    /**
     * Determine if the request URI that matches one of the configured exceptions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach (self::getExceptions() as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }

    public static function setExceptions($except = [])
    {
        self::$except = $except;
    }

    public static function getExceptions()
    {
        return self::$except;
    }
}
