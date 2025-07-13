<?php

    headerTienda($data);
    $arrProductos = $data['productos'];
?>
<br><br><br>
<hr>

<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
       <h3><?= $data['page_title']; ?></h3>
            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                 
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                     Categoria 
                </div>
            </div>

              <!-- Filter -->
              <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Ordenar por
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="http://localhost/estancias2/tienda/categoria/Bobas" class="filter-link stext-106 trans-04">
                                    Boba
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="http://localhost/estancias2/tienda/categoria/Cafe-Frio" class="filter-link stext-106 trans-04">
                                    Cafe frio
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="http://localhost/estancias2/tienda/categoria/Cafe-Caliente" class="filter-link stext-106 trans-04">
                                    Cafe caliente
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="http://localhost/estancias2/tienda/categoria/Paninis" class="filter-link stext-106 trans-04">
                                    Paninis
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="http://localhost/estancias2/tienda/categoria/Postres" class="filter-link stext-106 trans-04">
                                    Postres
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="http://localhost/estancias2/tienda/categoria/Perlas" class="filter-link stext-106 trans-04">
                                    Perlas
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="http://localhost/estancias2/tienda/categoria/Extras" class="filter-link stext-106 trans-04">
                                    Extras
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="http://localhost/estancias2/tienda/categoria/Ofertas" class="filter-link stext-106 trans-04">
                                    Ofertas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row isotope-grid">
        <?php
        if(!empty($arrProductos)){ 
            for ($p = 0; $p < count($arrProductos); $p++) {
                
        ?>

            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                    <img src="/estancias2/assets/images/uploads/<?= $arrProductos[$p]['portada'] ?>" alt="<?= $arrProductos[$p]['nombre'] ?>">
                    <a href="<?= base_url().'/tienda/producto/'.str_replace(' ', '-', $arrProductos[$p]['nombre']); ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Ver Producto
						</a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="<?= base_url().'/tienda/producto/'.str_replace(' ', '-', $arrProductos[$p]['nombre']); ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
    						<?= $arrProductos[$p]['nombre'] ?></a>
                            <?= $arrProductos[$p]['descripcion'] ?>
                            </a>

                            <span class="stext-105 cl3">
                            <?= SMONEY.formatMoney($arrProductos[$p]['precio']) ?>                            </span>
                        </div>

                        <div class="block2-txt-child2 flex-r p-t-3">
                            <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                <img class="icon-heart1 dis-block trans-04" src="<?= media(); ?>/tienda/images/icons/icon-heart-01.png" alt="ICON">
                                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="<?= media(); ?>/tienda/images/icons/icon-heart-02.png" alt="ICON">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <?php
            }
        }else{
            echo "😕 ¡Vaya! No encontramos lo que buscas!!<br>"; 
            echo "No hemos podido encontrar el producto que estás buscando. Tal vez ya no esté disponible o hubo un pequeño error en la búsqueda. <br>";
        }
        
                ?>

        </div>

        <!-- Load more 
        <div class="flex-c-m flex-w w-full p-t-45">
            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Load More
            </a>
        </div>-->
    </div>
</div>


<?php

    footerTienda($data);

?>