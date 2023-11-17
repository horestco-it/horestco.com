<?php

class Pages extends HRC_Controller {

  protected $data = array();

  public function __construct()
  {
    parent::__construct();

    // $this->data['menus'] = $this->mainMenu();
  }

  public function statis($page = 'home')
  {
    $page = filter_var($page, FILTER_SANITIZE_STRING);

    if ( ! file_exists(VIEWPATH.'pages/'.$page.'.php'))
    {
      return redirect('sitemap');
    }
    
    $this->data['page'] = $page;

    $this->data['site'] = Page::where('slug', $page)->first(); // ke depan pakai ini untuk dinamis

    $this->load->view('pages/'.$page, $this->data);
  }

  public function sitemap()
  {

    $this->data['sites'] = $this->pages(['static', 'catalog', 'portfolio']);

    $this->data['page'] = __FUNCTION__;

    $this->load->view('pages/'.$this->data['page'], $this->data);
  }

  public function portfolio($slug = 'portfolio')
  {
    $slug = str_slug(filter_var($slug, FILTER_SANITIZE_STRING));

    $data['page'] = 'portfolio';

    $data['menus'] = $this->mainMenu();

    if($slug == 'portfolio')
    {
      // override
      $data['portfolio'] = PortoClient::enabled()->take(12)->orderByRaw("RAND()")->get();

      $this->load->view('pages/portfolio', $data);
    }
    // portfolio clients
    else{
      $this->load->helper('image');

      $data['portfolio'] = $this->getPortfolios($this->uri->segment(1)."/".$slug);
    
      $this->load->view('pages/portfolio/clients', $data);
    }
  }

  /**
   * Portfolio client detail
   *
   **/
  public function client($slug, $page = '')
  {
    $slug = filter_var($slug, FILTER_SANITIZE_STRING);

    $client = PortoClient::whereSlug($slug)
                          ->enabled()
                          ->with(array(
                            'page',
                            'images' => function($query){
                              $query->orderBy('is_primary', 'desc');
                            }
                          ))
                          ->first();

    $productImages = Image::whereIn('product_id', $client->products->lists('id'))
                  ->primary()
                  ->with([
                    'product'
                  ])
                  ->get();

    if(is_null($client))
    {
      show_404();
    }

    $alt_format = [
      rtrim($client->page['name'], 's') . ' furniture',
      strtolower($client->name)
    ];

    $title = [
      rtrim($client->page['name'], 's') . ' furniture',
      'malaysia -',
      strtolower($client->name)
    ];

    $data = array(
      'menus'     => $this->mainMenu(),
      'client'    => $client,
      'productImages'  => $productImages,
      'page'      => 'portfolio',
      'altThumb'       => rtrim(implode(' ', $alt_format), ' '),
      'titleThumb'  => rtrim(implode(' ', $title), ' ')
    );



    // retreive productname

    if($client->products){

      $scopes = $client->products->lists('name');

      array_push($alt_format, strtolower(implode(', ', $scopes)) );

      array_push($title, strtolower(implode(', ', $scopes)) );

      $data['alt'] = rtrim(implode(' ', $alt_format), ' ');

      $data['title'] = str_replace(' -', '', rtrim(implode(' ', $title), ' '));

    }

    $this->load->view('pages/portfolio/client'.$page, $data);

  }

// TEMPORARY
  public function test()
  {
    vd(session_id());
  }

  public function dynamic()
  {
    $subcatid = Submenu::getSubcatIds();

    $products = Subcategory::productLists('id', $subcatid)->get();

    // vd($products->toArray());
    // 
    $fillable = true;

    foreach ($products as $key => $sub) {
      foreach ($sub->products as $key => $product) {
        if ($product->sizes->count() == 0) {

          echo $product->name. " - ". $product->id ."<br>";

          if($fillable)
          {
            // add ProductSize
            $sizeId = ProductSize::insert([
                'product_id' => $product->id,
                'name' => 'standard',
                'dimension' => '',
              ]);

            $price = ProductPrice::where('product_id', $product->id)->first();

            if(!is_null($price) && $sizeId)
            {
              // update product_size_id
              echo $price->normal."<br>";

              $price->product_size_id = $sizeId;
              if( $price->save() )
              {
                echo "-- berhasil update size_id -- <br>";
              }
              else{
                echo "-- gagal update size_id -- <br>";
              }
            }
            else{
              // add product::price
              $id = ProductPrice::insert([
                  'product_id' => $product->id,
                  'product_size_id' => $sizeId,
                  'created_at'  => $this->dateNow()
                ]);

              if($id)
              {
                echo "-- berhasil tambah price -- <br>";
              }
              else{
                echo "-- gagal tambah price -- <br>";
              }
            }
          }
        }
      }
    }
  }

}