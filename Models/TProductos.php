<?php
require_once("Libraries/Core/Mysql.php");

trait TProductos{
    private $con;
    private $strCategoria;
    private $intIdcategoria;
    public function getProductosT(){
        $this->con = new Mysql();
        $sql = "SELECT p.idproducto,
                        p.nombre,
                        p.descripcion,
                        p.categoriaid,
                        c.nombre as categoria,
                        p.precio,
                        p.portada 
                FROM productos p 
                INNER JOIN categoria c
                ON p.categoriaid = c.idcategoria
                WHERE p.status != 0 ";
                $request = $this->con->select_all($sql);
        return $request;
    }	

    public function getProductosCategoriaT(string $categoria){
        $this->strCategoria = $categoria;
        $this->con = new Mysql();

        $sql_cat = "SELECT idcategoria FROM categoria WHERE nombre = '{$this->strCategoria}'";
        $request = $this->con->select($sql_cat);
          
        if(!empty($request)){
            $this->intIdcategoria = $request['idcategoria'];
            $sql = "SELECT p.idproducto,
                            p.nombre,
                            p.descripcion,
                            p.categoriaid,
                            c.nombre as categoria,
                            p.precio,
                            p.portada 
                    FROM productos p 
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE p.status != 0 AND p.categoriaid = $this->intIdcategoria ";
                    $request = $this->con->select_all($sql);
            return $request;
        }	 

        }   


}

?>