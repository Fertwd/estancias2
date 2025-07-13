<?php 

	class ProductosModel extends Mysql
	{


		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;
		private $intCategoriaId;
		private $intPrecio;
		private $intStatus;
		private $strImagen;

		public function __construct()
		{
			parent::__construct();
		}	

		public function selectProductos(){
			$sql = "SELECT p.idproducto,
							p.nombre,
							p.descripcion,
							p.categoriaid,
							c.nombre as categoria,
							p.precio,
							p.status 
					FROM productos p 
					INNER JOIN categoria c
					ON p.categoriaid = c.idcategoria
					WHERE p.status != 0 ";
					$request = $this->select_all($sql);
			return $request;
		}	


		public function selectProducto(int $idproducto) {
			$this->intIdProducto = $idproducto;
			$sql = "SELECT * FROM productos WHERE idproducto = {$this->intIdProducto}";
			$request = $this->select($sql);
			return $request;
		}
		

		public function insertProducto(string $nombre, string $descripcion, int $categoriaid, string $precio, string $portada, int $status){
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->strPortada = $portada;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM productos WHERE nombre = '{$this->strNombre}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO productos(categoriaid,
														nombre,
														descripcion,
														precio,
														portada,
														status) 
								  VALUES(?,?,?,?,?,?)";
	        	$arrData = array($this->intCategoriaId,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
        						$this->strPortada,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateProducto(int $idproducto, string $nombre, string $descripcion, int $categoriaid, string $precio, string $portada, int $status){
			// Asignar los valores a las propiedades
			$this->intIdProducto = $idproducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->strPortada = $portada;
			$this->intStatus = $status;
		
			// Comprobar si el producto con el idproducto ya existe
			$sql = "SELECT * FROM productos WHERE idproducto = {$this->intIdProducto}";
			$request = $this->select_all($sql);
		
			if (!empty($request)) {
				// Si el producto existe, se procede a la actualización
				$sql = "UPDATE productos SET 
							nombre = ?, 
							descripcion = ?, 
							categoriaid = ?, 
							precio = ?, 
							portada = ?, 
							status = ? 
						WHERE idproducto = ?";
				$arrData = array(
					$this->strNombre,
					$this->strDescripcion,
					$this->intCategoriaId,
					$this->strPrecio,
					$this->strPortada,
					$this->intStatus,
					$this->intIdProducto
				);
				$request = $this->update($sql, $arrData);
			} else {
				// Si no se encuentra el producto, se retorna "no encontrado"
				$request = "no_found";
			}
		
			return $request;
		}
	
		
		public function deleteProducto(int $idproducto)
		{
			$this->intIdproducto = $idproducto;
		
			// Eliminación directa sin validación
			$sql = "DELETE FROM productos WHERE idproducto = $this->intIdproducto";
			$request = $this->delete($sql);
		
			if ($request) {
				// Si la eliminación es exitosa
				$request = 'ok';
			} else {
				// Si ocurre un error al intentar eliminar el producto
				$request = 'error';
			}
		
			return $request;
		}
		

}
 ?>