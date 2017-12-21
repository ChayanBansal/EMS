<?php 
class input_field
{
	private $value;
	
	public function input_safe($post_input)
	{
		$this->value=strtoupper(htmlspecialchars(strip_tags($post_input)));
	}
}
?>
