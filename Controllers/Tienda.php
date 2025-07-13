<?php 
require_once("Models/TCategoria.php");
require_once("Models/TProductos.php");
	class Tienda extends Controllers{
		use TCategoria, TProductos;
		public function __construct()
		{
			parent::__construct();
		}
		public function tienda()
		{
			$data['page_tag'] = "Boba Time and Coffee";
			$data['page_title'] = "Boba Time and Coffee";
			$data['page_name'] = "Tienda";
			$data['productos'] = $this->getProductosT();
			$this->views->getView($this,"tienda",$data);
		}

        public function categoria($params) {
            if (empty($params)) {
              header("Location:".base_url());
            }else{
				$categoria = strClean($params);
                $data['page_tag'] = "Boba Time and Coffee | $categoria";
                $data['page_title'] = "$categoria";
                $data['page_name'] = "Categoria";
                $data['productos'] = $this->getProductosCategoriaT($categoria);
                $this->views->getView($this,"categoria",$data);
            }
          }
          
          

	}
 ?>