<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        $xml .= '    <url><loc>'.url('/').'</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>'."\n";
        $xml .= '    <url><loc>'.url('/about').'</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>'."\n";
        $xml .= '    <url><loc>'.url('/services').'</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>'."\n";
        $xml .= '    <url><loc>'.url('/contact').'</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>'."\n";
        $xml .= '    <url><loc>'.url('/shop').'</loc><changefreq>daily</changefreq><priority>0.8</priority></url>'."\n";
        $xml .= '    <url><loc>'.url('/faq').'</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>'."\n";
        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
