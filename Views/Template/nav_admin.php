    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">Fernando Zapata</p>
          <p class="app-sidebar__user-designation">Administrador</p>
        </div>
      </div>
      <ul class="app-menu">
        <li>
          <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
            <i class="app-menu__icon fa fa-dashboard"></i>
            <span class="app-menu__label">Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
            <span class="app-menu__label">Usuarios</span>
            <i class="treeview-indicator fa fa-angle-right">

            </i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item" href="<?= base_url(); ?>/usuarios">
                <i class="icon fa fa-circle-o"></i> Usuarios
              </a>
            </li>
            <li>
              <a class="treeview-item" href="<?= base_url(); ?>/roles">
                <i class="icon fa fa-circle-o"></i> Roles
              </a>
            </li>
            <li>
              <a class="treeview-item" href="<?= base_url(); ?>/permisos">
                <i class="icon fa fa-circle-o"></i> Permisos
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-archive" aria-hidden="true""></i>
            <span class="app-menu__label">Productos</span>
            <i class="treeview-indicator fa fa-angle-right">

            </i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item" href="<?= base_url(); ?>/usuarios">
                <i class="icon fa fa-circle-o"></i> Bobas
              </a>
            </li>
            <li>
              <a class="treeview-item" href="<?= base_url(); ?>/roles">
                <i class="icon fa fa-circle-o"></i> Cafe frio
              </a>
            </li>
            <li>
              <a class="treeview-item" href="<?= base_url(); ?>/permisos">
                <i class="icon fa fa-circle-o"></i> Cafe caliente
              </a>
            </li>
            <li>
              <a class="treeview-item" href="<?= base_url(); ?>/permisos">
                <i class="icon fa fa-circle-o"></i> Paninis
              </a>
            </li>
            <li>
              <a class="treeview-item" href="<?= base_url(); ?>/permisos">
                <i class="icon fa fa-circle-o"></i> Postres
              </a>
            </li>
            <li>
              <a class="treeview-item" href="<?= base_url(); ?>/permisos">
                <i class="icon fa fa-circle-o"></i> Perlas
              </a>
            </li>
            <li>
              <a class="treeview-item" href="<?= base_url(); ?>/permisos">
                <i class="icon fa fa-circle-o"></i> Extras
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a class="app-menu__item" href="<?= base_url(); ?>/logout">
            <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
            <span class="app-menu__label">Logout</span>
          </a>
        </li>
      </ul>
    </aside>