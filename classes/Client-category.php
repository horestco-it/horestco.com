<?php 

require 'CRUD.class.php';


class Portfolio extends Crud

{

	# The table you want to perform the database actions on

  protected $table = 'portocategory';



  # Primary Key of the table

  protected $pk  = 'portoid';



  public function __construct()

  {

  	$this->db = new DB();

  }



  public function table($table, $pk)

  {

    $this->table = ( empty($table) ) ? $this->table : $table;

    $this->pk = ( empty($pk) ) ? $this->pk : $pk;

  }



  public function pk($pk)

  {

    $this->pk = ( empty($pk) ) ? $this->$pk : $pk;

  }



  public function all()

  {

    $sql = " SELECT * FROM ". $this->table;

    return $this->db->query(" $sql ");

  }



  public function where_id($id)

  {

    

    $this->db->bind(':id', $id);

    $sql = " SELECT * FROM  ". $this->table . " WHERE " . $this->pk . " = :id " ;

    return $this->db->query($sql);

  }



  public function order_by_id()

  {

  		$sql = "SELECT * FROM ". $this->table ." ORDER BY ". $this->pk;

  		return $this->db->query($sql);

  }



  public function order_by($column)

  {

  	$column = ( empty($column) ) ? $this->pk : $column;



  	if (!empty($column)) {

  		$sql = "SELECT * FROM ". $this->table ." ORDER BY ". $column;

  		return $this->db->query($sql);

  	}

  }

}







// instant object  

$portfolio = new Portfolio();

$portocategory = $portfolio->order_by_id(); // SELECT * FROM portocategory ORDER BY portoid



 ?>