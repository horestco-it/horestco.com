<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Get_metadata extends CI_Controller
{
    protected $logger;

    public function __construct()
    {
        parent::__construct();
        $this->logger = new Logger('LOG');
        $this->logger->pushHandler(new StreamHandler(APPPATH.'logs/metadata.log', Logger::DEBUG));
    }
    
    public function index()
    {
        try {
            $this->load->library('SheetDB');
            $metadataValues = $this->sheetdb->get();
            $message = null;
    
            if($metadataValues && count($metadataValues) > 0){
                $data = [];
    
                foreach ($metadataValues as $item) {
                    if($item->ID && $item->PAGE) {
                        $data[] = [
                            'id' => (int)preg_replace('/^\s+|\s+$/', '', $item->ID),
                            'page' => preg_replace('/^\s+|\s+$/', '', $item->PAGE),
                            'title' => $item->TITLE ? preg_replace('/^\s+|\s+$/', '', $item->TITLE) : '',
                            'description' => $item->DESCRIPTION ? preg_replace('/^\s+|\s+$/', '', $item->DESCRIPTION) : '',
                            'keywords' => $item->KEYWORDS ? preg_replace('/^\s+|\s+$/', '', $item->KEYWORDS) : '',
                        ];
                    }
                }
                if(count($data)){
                    Metadata::truncate();
                    if( $insert = Metadata::insert($data) ){
                        $message = 'Success update metadata';
                        $this->logger->info($message);
                        echo $message;
                        return;
                    }
    
                }
            }
            $message = 'Unable get metadata';
            $this->logger->error($message);
            throw new \Exception($message);
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function log()
    {
        try {

            // create a log channel
            $r = preg_replace('/^\s+|\s+$/', '', ' GG HH FF        ');
            echo "log->||".$r.'||';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        // log_message('error', 'Some variable did not contain a value.');
    }
}