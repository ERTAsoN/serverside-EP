<?php
namespace Middlewares;


use Src\Request;
use Collect\Collect;

class SpecialCharsMiddleware
{
    public function handle(Request $request): Request
    {
        Collect::collection($request->all())
            ->each(function ($value, $key, $request) {
                $request->set($key, is_string($value) ? htmlspecialchars($value) : $value);
            }, $request);

        return $request;
    }
}