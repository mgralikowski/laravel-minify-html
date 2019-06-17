<?php

namespace Eolme\Minify\Middleware;

use Closure;
use Eolme\Minify\Minifier;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MinifyResponse
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var Response $response */
        $response = $next($request);

        if ($this->shouldProcess($response)) {
            return $response->setContent((new Minifier())->html($response->getContent()));
        }

        return $response;
    }

    /**
     * Check if the content type header is html.
     *
     * @param \Illuminate\Http\Response $response
     *
     * @return bool
     */
    protected function isHtml($response): bool
    {
        return 0 === mb_strpos($response->headers->get('Content-Type'), 'text/html');
    }

    /**
     * Check if the response should be processed.
     *
     * @param \Illuminate\Http\Response $response
     *
     * @return bool
     */
    protected function shouldProcess($response): bool
    {
        if ($response instanceof BinaryFileResponse) {
            return false;
        }

        if ($response instanceof StreamedResponse) {
            return false;
        }

        return $this->isHtml($response);
    }
}
