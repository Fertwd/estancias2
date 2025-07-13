<?php 
	class Tienda extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}
		public function nosotros()
		{
			$data['page_tag'] = "Boba Time and Coffee";
			$data['page_title'] = "Boba Time and Coffee";
			$data['page_name'] = "Boba Time and Coffee";
            $this->views->getView($this, "nosotros", $data);
		}

	}
 ?>