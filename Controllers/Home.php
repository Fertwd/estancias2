<?php 
require_once("Models/TCategoria.php");
require_once("Models/TProductos.php");
	class Home extends Controllers{
		use TCategoria, TProductos;
		public function __construct()
		{
			parent::__construct();
		}
		public function home()
		{
			$data['page_tag'] = "Boba Time and Coffee";
			$data['page_title'] = "Boba Time and Coffee";
			$data['page_name'] = "Boba Time and Coffee";
			$data['slider'] = $this->getCategoriasT(CAT_SLIDER);
			$data['banner'] = $this->getCategoriasT(CAT_BANNER);
			$data['productos'] = $this->getProductosT();
			$this->views->getView($this,"home",$data);
		}

	}
 ?>