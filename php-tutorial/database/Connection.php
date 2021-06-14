<?php 

  class Connection

  {

	  	public static function make($config) //it is accesible globallly
	  	{
			  		try {

				

				return new PDO(
					$config['connection'].';dbname='.$config['name'],
					$config['username'],
					$config['password'],
					$config['options']
				);


			} catch (PDOException $e) {
				   echo $e->getMessage();
	  	}
  }
}



?>