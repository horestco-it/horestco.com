<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'Base.php';

use Illuminate\Support\Str;
use NilPortugues\Sitemap\Sitemap as SitemapService;
use NilPortugues\Sitemap\Item\Url\UrlItem;
use NilPortugues\Sitemap\SitemapException;

class Sitemap extends Base {

	public function __construct()
	{
		parent::__construct();
		if ($this->auth('type') != 'A')
		{
			echo "Access Denied";
			return false;
		}
	}

	public function index()
	{
		$this->data['page'] = 'sitemap-utility';

		$this->data['sitemaps'] = \Horestco\My\Model\Sitemap::where('is_used', 0)->orderBy('created_at', 'desc')->get();

		$this->load->view($this->template, $this->data);
	}

	public function generate()
	{
		// lihat documentasi di https://github.com/nilportugues/php-sitemap#43---build-a-simple-sitemap

		if ($this->input->post('data'))
		{
			$draft = uniqid('sitemap-draft_').'.xml';
			$count = 0;
			try {
		    $sitemap = new SitemapService(FCPATH.'sitemaps/', $draft);
		    // generate static page
		    foreach ($this->pages() as $key => $page) {
					$domain = 'http://horestco.com.my/';
					if ($key == 0) {
						$priority = '1.0';
					}
					else{
						$priority = '0.8';
						$domain = $domain.$page->slug;
					}
			    $item = new UrlItem($domain);
			    $item->setPriority($priority); //Optional
			    $item->setChangeFreq('weekly'); //Optional
			    $sitemap->add($item);
			    $count++;
		    }
		    // generate catalog products
		    foreach ($this->getProducts() as $key => $product) {
					$domain = 'http://horestco.com.my/furniture/';
		    	$priority = '0.8';
			    $item = new UrlItem($domain.Str::slug($product->name.'-'.$product->id));
			    $item->setPriority($priority); //Optional
			    $item->setChangeFreq('weekly'); //Optional
			    $sitemap->add($item);
			    $count++;
		    }
		    // generate catalog products
		    foreach (PortoClient::enabled()->get() as $key => $client) {
					$domain = 'http://horestco.com.my/client/';
		    	$priority = '0.8';
			    $item = new UrlItem($domain.$client->slug);
			    $item->setPriority($priority); //Optional
			    $item->setChangeFreq('weekly'); //Optional
			    $sitemap->add($item);
			    $count++;
		    }

		    // write to file
		    $sitemap->build();

		    // record to db
		    $data = array(
		    	'name' => $draft,
		    	'url_count' => $count,
		    	'created_at' => \Carbon\Carbon::now('Asia/Jakarta'),
		    );
		    $insert = \Horestco\My\Model\Sitemap::insertGetId($data);

		    $data['id'] = $insert;
		    if($insert) print_r(json_encode($data));

			} catch (SitemapException $e) {
			   echo $e->getMessage();
			}
		}
	}

	public function useit() {
		if ($this->input->post('action') == 'useit')
		{
			$sitemap = \Horestco\My\Model\Sitemap::find($this->input->post('id'));
			if (file_exists($file = FCPATH.'sitemaps/'.$sitemap->name))
			{
				$current = FCPATH.'sitemap.xml';
				// backup
				rename($current, FCPATH.'sitemaps/'.Str::slug($this->dateNow()).'.xml');

				if( rename($file, $current) )
				{
					echo $sitemap->delete();
				}
			}
		}
		return false;
	}

}

/* End of file Sitemap.php */
/* Location: ./application/controllers/Sitemap.php */