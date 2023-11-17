<?php
// backup sitemap.xml
$backup = FCPATH.'sitemap-copy-'.str_slug(\Carbon\Carbon::now('Asia/Jakarta')).'.xml';
$file = FCPATH.'sitemap.xml';
// if(!copy($file, $backup)) return false;

// use SitemapPHP\Sitemap;

// $sitemap = new Sitemap('http://horestco.com.my');   
// $sitemap->setPath(FCPATH);
// $sitemap->addItem('/', '1.0', 'daily', 'Today');
// $sitemap->addItem('/about', '0.8', 'monthly', 'Jun 25');
// $sitemap->addItem('/contact', '0.6', 'yearly', '14-12-2009');
// $sitemap->addItem('/otherpage');
// sleep(3);
$current = "</urlset>";
file_put_contents($file, $current, FILE_APPEND);