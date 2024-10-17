<?php
use SheetDB\SheetDB as SheetDBBase;

class SheetDB
{
    protected $values;
    protected $sheetdb;

    public function __construct()
    {
        $this->sheetdb = new SheetDBBase('8vt8lwtw4o6bw');
    }

    public function get()
    {
        $this->values = $this->sheetdb->get(); // returns all spreadsheets data
        return $this->values;
    }
}
