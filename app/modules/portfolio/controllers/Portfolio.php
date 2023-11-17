<?php

/**
* 
*/
class Portfolio extends HRC_Controller
{
	public function __construct()
  {
    parent::__construct();

    $this->data['page'] = __class__;
  }

  public function index()
  {
  	// override
    $this->data['portfolio'] = PortoClient::enabled()->take(10)->sort()->get();

    $this->load->view('pages/portfolio', $this->data);
  }

  public function category($slug)
  {
    $slug = str_slug(filter_var($slug, FILTER_SANITIZE_STRING));

    $this->load->helper('image');

    $this->data['portfolio'] = $this->getPortfolios($this->uri->segment(1)."/".$slug);

    // vd($this->data['portfolio']->toArray());
  
    $this->load->view('category', $this->data);
  }

  /**
   * Portfolio client detail
   *
   **/
  public function client($slug)
  {
    $slug = filter_var($slug, FILTER_SANITIZE_STRING);

    $client = PortoClient::whereSlug($slug)
                          ->enabled()
                          ->with(array(
                          	'products',
                            'page',
                            'images' => function($query){
                              $query->orderBy('is_primary', 'desc');
                            }
                          ))
                          ->first();

    if(is_null($client))
    {
      show_404();
    }

    // vd($slug);return;

    $productImages = Image::whereIn('product_id', $client->products->pluck('id')->toArray())
                  ->primary()
                  ->with([
                    'product'
                  ])
                  ->get();

    $alt_format = [
      rtrim($client->page['name'], 's') . ' furniture',
      strtolower($client->name)
    ];

    $title = [
      rtrim($client->page['name'], 's') . ' furniture',
      'malaysia -',
      strtolower($client->name)
    ];

    $this->data['client'] = $client;
    $this->data['productImages']  = $productImages;
    $this->data['altThumb'  ]     = rtrim(implode(' ', $alt_format), ' ');
    $this->data['titleThumb']  = rtrim(implode(' ', $title), ' ');



    // retreive productname

    if($client->products){

      $scopes = $client->products->pluck('name')->toArray();

      array_push($alt_format, strtolower(implode(', ', $scopes)) );

      array_push($title, strtolower(implode(', ', $scopes)) );

      $this->data['alt'] = rtrim(implode(' ', $alt_format), ' ');

      $this->data['title'] = str_replace(' -', '', rtrim(implode(' ', $title), ' '));

    }

    $this->load->view('client', $this->data);

  }
}