<?php
$xml  = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ';
$xml .= 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ';
$xml .= 'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 ';
$xml .= 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

$xml .= '<url><loc>http://horestco.com.my/</loc><changefreq>weekly</changefreq><priority>1.00</priority></url>';

$xml .= '</urlset>';

echo $xml;