<?php 

 function presentPrice($price)
  {
  	return money_format('$%i', $price / 100);
  }
  function setActive($category,$output='active')
  {
  	return request()->category == $category ? $output :'';
  }




 ?>