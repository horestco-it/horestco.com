<?php

class Pages extends HRC_Controller {

  protected $data = array();

  public function __construct()
  {
    parent::__construct();
  }

  public function single($page = 'home')
  {
    // $this->output->cache(2);
    
    $this->data['version'] = $this->input->get('v') ? '-'.$this->input->get('v') : '';

    $page = filter_var($page, FILTER_SANITIZE_STRING).$this->data['version'];


    if ( ! file_exists(APPPATH.'modules/pages/views/'.$page.'.php'))
    {
      return redirect('sitemap');
    }

    
    $this->data['page'] = $page;

    $this->data['site'] = Page::where('slug', $page)->first(); // ke depan pakai ini untuk dinamis

    if($this->input->get('old')){
      $this->load->view('old/'.$page, $this->data);
      return;
    }
    $this->load->view($page, $this->data);
  }

  public function sitemap()
  {

    $this->data['sites'] = $this->pages(['static', 'catalog', 'portfolio']);

    $this->data['page'] = __FUNCTION__;

    $this->load->view($this->data['page'], $this->data);
  }

// TEMPORARY
  public function test()
  {
    vd(session_id());
  }

}