<?php
use SheetDB\SheetDB as SheetDBBase;

class SheetDB
{
    protected $values;

    public function __construct()
    {
        $this->sheetdb = new SheetDBBase('r6ob29yy8mnw7');
        
    }

    public function get()
    {
        $this->values = $this->sheetdb->get(); // returns all spreadsheets data
        return $this->values;
    }
}
