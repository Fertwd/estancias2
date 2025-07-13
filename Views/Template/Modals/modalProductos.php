<!-- Modal -->
<div class="modal fade" id="modalFormProductos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formProductos" name="formProductos" class="form-horizontal">
              <input type="hidden" id="idProducto" name="idProducto" value="">
              <input type="hidden" id="foto_actualp" name="foto_actualp" value="">
              <input type="hidden" id="foto_removep" name="foto_removep" value="0">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
                <div class="col-md-8">
                  <div class="form-group">
                      <label class="control-label">Nombre Producto <span class="required">*</span></label>
                      <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre Producto" required="">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Descripción <span class="required">*</span></label>
                      <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción Producto" required=""></textarea>
                    </div>
                </div>                

                <div class="form-group col-md-6">
                <label class="control-label">Precio <span class="required">*</span></label>
                <input class="form-control" id="txtPrecio" name="txtPrecio" type="text" required="">
                </div>
                
                <div class="row">
                        <div class="form-group col-md-6">
                            <label for="listCategoria">Categoría <span class="required">*</span></label>
                            <select class="form-control" data-live-search="true" id="listCategoria" name="listCategoria" required=""></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="listStatus">Estado <span class="required">*</span></label>
                            <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                              <option value="1">Activo</option>
                              <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                   
                   <div class="photo">
                   <div style="display: flex; justify-content: center; align-items: center; height: 3vh;">
                      <label for="foto">Foto (570x380)</label>
                  </div>
                       <div class="prevPhoto">
                         <span class="delPhoto notBlock">X</span>
                         <label for="foto"></label>
                         <div>
                           <img id="img" src="<?= media(); ?>/images/portada_categoria.png">
                         </div>
                       </div>
                       <div class="upimg">
                         <input type="file" name="foto" id="foto">
                       </div>
                       <div id="form_alert"></div>
                   </div>

                <div class="row">
                <div class="form-group col-md-6">
                <button id="btnActionForm" class="btn btn-primary btn-md btn-block" type="submit">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span>
                </button>
            </div>
            <div class="form-group col-md-6">
                <button class="btn btn-danger btn-md btn-block" type="button" data-dismiss="modal">
                    <i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar
                </button>
            </div>

                </div>
                </div>
              </div>
              <div class="tile-footer">


              </div>
            </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalViewProducto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content" >
      <div class="modal-header header-primary" style="background-color: #98FF98;">
      <h5 class="modal-title" id="titleModal" style="color: white;">Datos del producto</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>ID:</td>
              <td id="prodId"></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="prodNombre"></td>
            </tr>
            <tr>
              <td>Descripción:</td>
              <td id="prodDescripcion"></td>
            </tr>
            <tr>
              <td>Precio:</td>
              <td id="prodPrecio"></td>
            </tr>
            <tr>
            <tr>
              <td>Estado:</td>
              <td id="prodEstado"></td>
            </tr>
            <tr>
              <td>Foto:</td>
              <td id="imgProd"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
