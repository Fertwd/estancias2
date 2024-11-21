<?php
class Roles extends Controllers {
    public function __construct() {
        parent::__construct();
    }

    public function Roles() {
        $data['page_id'] = 3;
        $data['page_tag'] = "Roles Usuario";
        $data['page_name'] = "rol_usuario";
        $data['page_title'] = "Roles Usuario <small>Boba Time and Coffe</small>";
        $this->views->getView($this, "roles", $data);
    }
}
?>
