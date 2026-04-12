<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        // Static pages
        $xml .= $this->url('/', 'weekly', '1.0');
        $xml .= $this->url('/about', 'monthly', '0.8');
        $xml .= $this->url('/services', 'weekly', '0.9');
        $xml .= $this->url('/shop', 'daily', '0.8');
        $xml .= $this->url('/faq', 'monthly', '0.6');
        $xml .= $this->url('/contact', 'monthly', '0.7');
        $xml .= $this->url('/careers', 'monthly', '0.5');
        $xml .= $this->url('/book-appointment', 'monthly', '0.7');

        // Dynamic service pages
        Service::active()->each(function (Service $service) use (&$xml): void {
            $xml .= $this->url(
                "/services/{$service->slug}",
                'monthly',
                '0.8',
                $service->updated_at->toAtomString()
            );
        });

        // Dynamic product pages
        Product::active()->each(function (Product $product) use (&$xml): void {
            $xml .= $this->url(
                "/shop/{$product->slug}",
                'weekly',
                '0.7',
                $product->updated_at->toAtomString()
            );
        });

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    private function url(string $path, string $changefreq, string $priority, ?string $lastmod = null): string
    {
        $loc = url($path);
        $entry = "    <url>\n";
        $entry .= "        <loc>{$loc}</loc>\n";
        if ($lastmod) {
            $entry .= "        <lastmod>{$lastmod}</lastmod>\n";
        }
        $entry .= "        <changefreq>{$changefreq}</changefreq>\n";
        $entry .= "        <priority>{$priority}</priority>\n";
        $entry .= "    </url>\n";

        return $entry;
    }
}
