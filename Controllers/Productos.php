<?php

class Productos extends Controllers{
    public function __construct()
    {
        parent::__construct();
        
    }

    public function Productos()
    {
        
        $data['page_tag'] = "Productos";
        $data['page_title'] = "PRODUCTOS <small>Tienda Virtual</small>";
        $data['page_name'] = "productos";
        $data['page_functions_js'] = "functions_productos.js";
        $this->views->getView($this,"productos",$data);
    }

    public function getProductos()
    {
        $arrData = $this->model->selectProductos();

        // Define permisos directamente
        $permisoLeer = true;   // Habilitar botón "Ver"
        $permisoEditar = true; // Habilitar botón "Editar"
        $permisoEliminar = true; // Habilitar botón "Eliminar"
    
        for ($i = 0; $i < count($arrData); $i++) {
            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';
    
            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
            }
    
            $arrData[$i]['precio'] = SMONEY . ' ' . formatMoney($arrData[$i]['precio']);
    
            // Botones según permisos
            if ($permisoLeer) {
                $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfoP(' . $arrData[$i]['idproducto'] . ')" title="Ver producto"><i class="fa fa-lock" aria-hidden="true"></i></button>';
            }
            if ($permisoEditar) {
                $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfoP(' . $arrData[$i]['idproducto'] . ')" title="Editar producto"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
            }
            if ($permisoEliminar) {
                $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfoP(' . $arrData[$i]['idproducto'] . ')" title="Eliminar producto"><i class="fa fa-trash" aria-hidden="true"></i></button>';
            }
    
            $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
        }
    
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function setProducto(){

        if($_POST){
            if(empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listCategoria']) || empty($_POST['listStatus'])){
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{

                $idProducto = intval($_POST['idProducto']);
                $strNombre = strClean($_POST['txtNombre']);
                $strDescripcion = strClean($_POST['txtDescripcion']);
                $intCategoriaId = intval($_POST['listCategoria']);
                $strPrecio = strClean($_POST['txtPrecio']);
                $intStatus = intval($_POST['listStatus']);
                $request_producto = "";
                
                $foto          = $_FILES['foto'];
                $nombre_fotop   = $foto['name'];
                $type          = $foto['type'];
                $url_temp      = $foto['tmp_name'];
                $imgPortada    = 'portada_categoria.png';
                
                if($nombre_fotop != ''){
                    $imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
                }

                if($idProducto == 0)
                {
                    $option = 1;
                        $request_producto = $this->model->insertProducto($strNombre, 
                                                                    $strDescripcion, 
                                                                    $intCategoriaId,
                                                                    $strPrecio, 
                                                                    $imgPortada,
                                                                    $intStatus );

                  }else{
                    // Actualizar
                    if ($nombre_fotop == '') {
                        if ($_POST['foto_actualp'] != 'portada_categoria.png' && $_POST['foto_removep'] == 0) {
                            $imgPortada = $_POST['foto_actualp'];
                        }
                    }
						$option = 2;
							$request_producto = $this->model->updateProducto($idProducto,
																		$strNombre,
																		$strDescripcion, 
																		$intCategoriaId,
																		$strPrecio,
                                                                        $imgPortada, 
																		$intStatus);
						} 

                        if($request_producto > 0 )
                        {
                            if($option == 1){
                                $arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
                                if($nombre_fotop != ''){ uploadImage($foto,$imgPortada); }

                            }else{
                                $arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
                                if($nombre_fotop != ''){ uploadImage($foto,$imgPortada); }

                                if (($nombre_fotop == "" && $_POST['foto_removep'] == 1 && $_POST['foto_actualp'] != "portada_categoria.png") 
                                    || ($nombre_fotop != "" && $_POST['foto_actualp'] != "portada_categoria.png")) {
                                    deleteFile($_POST['foto_actualp']);
                                }

                            }
                        }else if($request_producto == 'exist'){
                            $arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el Código Ingresado.');		
                        }else{
                            $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                        }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }


    public function getProducto(int $idProducto)
    {
        $idProducto = intval($idProducto);
        if ($idProducto > 0) { // Corregida la validación
            $arrData = $this->model->selectProducto($idProducto); // Usamos $idProducto
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrData['url_portada'] = media().'/images/uploads/'.$arrData['portada'];
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            //dep($arrData); exit;
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }


    public function delProducto()
    {
        if($_POST){
                $intIdproducto = intval($_POST['idProducto']);
                $requestDelete = $this->model->deleteProducto($intIdproducto);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un producto');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

}

?>    