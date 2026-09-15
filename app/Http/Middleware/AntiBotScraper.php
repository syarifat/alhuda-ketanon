<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AntiBotScraper
{
    /**
     * Known malicious scrapers, vulnerability scanners, and abusive automated bots.
     * Legitimate search engines (Googlebot, Bingbot, etc.) are excluded and allowed.
     */
    protected array $badBots = [
        'semrushbot',
        'ahrefsbot',
        'mj12bot',
        'dotbot',
        'petalbot',
        'megaindex',
        'blexbot',
        'seekport',
        'serpstatbot',
        'zoominfobot',
        'dataforseo',
        'babbar',
        'bytespider',
        'sqlmap',
        'nikto',
        'havij',
        'nmap',
        'masscan',
        'zgrab',
        'dirbuster',
        'wprecon',
        'gobuster',
    ];

    /**
     * Known exploit / vulnerability probe paths that waste serverless resources.
     */
    protected array $probedPaths = [
        'wp-login.php',
        'wp-admin',
        'xmlrpc.php',
        'phpmyadmin',
        'pma',
        '.git',
        '.env',
        'actuator',
        'telescope',
        'telescope/requests',
        'eval-stdin.php',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = strtolower($request->header('User-Agent', ''));
        $uri = strtolower($request->path());

        // 1. Block known vulnerability probing instantly before touching database
        foreach ($this->probedPaths as $probe) {
            if (str_contains($uri, $probe)) {
                return response('Access Denied', 403);
            }
        }

        // 2. Reject empty User-Agent from public requests
        if (empty($userAgent)) {
            return response('Access Denied: Missing User-Agent', 403);
        }

        // 3. Block known aggressive scrapers and SEO spam crawlers
        foreach ($this->badBots as $badBot) {
            if (str_contains($userAgent, $badBot)) {
                return response('Access Denied: Automated scraping prohibited', 403);
            }
        }

        return $next($request);
    }
}
