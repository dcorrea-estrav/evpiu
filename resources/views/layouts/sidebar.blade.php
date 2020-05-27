<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Home</li>
            <li class="{{ request()->route()->named('home') ? 'mm-active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="metismenu-icon pe-7s-home"></i>
                    Home
                </a>
            </li>
            <li class="{{ request()->route()->named('blog') ? 'mm-active' : '' }}">
                <a href="{{ route('blog') }}">
                    <i class="metismenu-icon pe-7s-global"></i>
                    Blog
                </a>
            </li>
            <li class="{{ request()->is('accesos_remotos') ? 'mm-active' : '' }}">
                <a href="{{ url('accesos_remotos') }}">
                    <i class="metismenu-icon pe-7s-paper-plane">
                    </i>Accesos remotos
                </a>
            </li>
            <li class="{{ request()->is('medida_prevencion') ? 'mm-active' : '' }}">
                <a href="{{ url('medida_prevencion') }}">
                    <i class="metismenu-icon pe-7s-like">
                    </i>Medida de prevencion
                </a>
            </li>
            <li class="{{ request()->route()->named('edit_medida_prevencion.*') ? 'mm-active' : '' }}">
                <a href="{{ url('edit_medida_prevencion') }}">
                    <i class="metismenu-icon pe-7s-magic-wand">
                    </i>G. Medida de prevencion
                </a>
            </li>
            <li class="app-sidebar__heading">Aplicativos</li>

            <li class="{{ request()->route()->named('artes.index') ? 'mm-active' : '' }}">
                <a href="{{ route('artes.index') }}">
                    <i class="metismenu-icon  pe-7s-pen"></i>
                    Artes
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-cash"></i>
                    Facturacion electronica
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li class="{{ request()->route()->named('fe.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('fe.index') }}">
                            <i class="metismenu-icon"></i>
                            Facturas
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('nc.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('nc.index') }}">
                            <i class="metismenu-icon">
                            </i>Notas credito
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('GestionFacturacionElectronica.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('GestionFacturacionElectronica.index') }}">
                            <i class="metismenu-icon">
                            </i>Gestion FE
                        </a>
                    </li>
                    <li class="{{ request()->is('ConfigFe') ? 'mm-active' : '' }}">
                        <a href="{{ url('ConfigFe') }}">
                            <i class="metismenu-icon">
                            </i>Configuracion
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="metismenu-icon  pe-7s-sun"></i>
                    Gestion ambiental
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon  pe-7s-graph1"></i>
                            Bitacora Omff
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li class="{{ request()->route()->named('bitacoraomff.create') ? 'mm-active' : '' }}">
                                <a href="{{ route('bitacoraomff.create') }}">
                                    <i class="metismenu-icon"></i>
                                    Registro P0XX
                                </a>
                            </li>
                            <li class="{{ (request()->is('bitacoraomff_hl1')) ? 'mm-active' : '' }}">
                                <a href="{{ url('bitacoraomff_hl1') }}">
                                    <i class="metismenu-icon"></i>
                                    Registro HL1
                                </a>
                            </li>
                            <li class="{{ request()->route()->named('bitacoraomff.index') ? 'mm-active' : '' }}">
                                <a href="{{ route('bitacoraomff.index') }}">
                                    <i class="metismenu-icon">
                                    </i>Gestion
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->route()->named('sensores.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('sensores.index') }}">
                            <i class="metismenu-icon  pe-7s-pen"></i>
                            Chimenea y gas
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Productos
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li class="{{ request()->route()->named('clonador.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('clonador.index') }}">
                            <i class="metismenu-icon"></i>
                            Clonador
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('codificador.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('codificador.index') }}">
                            <i class="metismenu-icon"></i>
                            Codificador
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon">
                            </i>Maestros
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li class="{{ request()->route()->named('ProdCievCodTipoProducto.index') ? 'mm-active' : '' }}">
                                <a href="{{ route('ProdCievCodTipoProducto.index') }}">
                                    <i class="metismenu-icon">
                                    </i>Tipo producto
                                </a>
                            </li>
                            <li class="{{ request()->route()->named('ProdCievCod.index') ? 'mm-active' : '' }}">
                                <a href="{{ route('ProdCievCod.index') }}">
                                    <i class="metismenu-icon">
                                    </i>Lineas
                                </a>
                            </li>
                            <li class="{{ request()->route()->named('ProdCievCodSublinea.index') ? 'mm-active' : '' }}">
                                <a href="{{ route('ProdCievCodSublinea.index') }}">
                                    <i class="metismenu-icon">
                                    </i>Sublineas
                                </a>
                            </li>
                            <li class="{{ request()->route()->named('ProdCievCodCaracteristica.index') ? 'mm-active' : '' }}">
                                <a href="{{ route('ProdCievCodCaracteristica.index') }}">
                                    <i class="metismenu-icon">
                                    </i>Caracteristicas
                                </a>
                            </li>
                            <li class="{{ request()->route()->named('ProdCievCodMaterial.index') ? 'mm-active' : '' }}">
                                <a href="{{ route('ProdCievCodMaterial.index') }}">
                                    <i class="metismenu-icon">
                                    </i>Materiales
                                </a>
                            </li>
                            <li class="{{ request()->route()->named('ProdCievCodMedida.index') ? 'mm-active' : '' }}">
                                <a href="{{ route('ProdCievCodMedida.index') }}">
                                    <i class="metismenu-icon">
                                    </i>Medidas
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Pedidos
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li class="{{ request()->route()->named('pedidos.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('pedidos.index') }}">
                            <i class="metismenu-icon">
                            </i>Ventas
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('PedidoCartera.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('PedidoCartera.index') }}">
                            <i class="metismenu-icon">
                            </i>Cartera
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('PedidoCostos.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('PedidoCostos.index') }}">
                            <i class="metismenu-icon">
                            </i>Costos
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('PedidoProduccion.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('PedidoProduccion.index') }}">
                            <i class="metismenu-icon">
                            </i>Produccion
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('PedidoBodega.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('PedidoBodega.index') }}">
                            <i class="metismenu-icon">
                            </i>Bodega
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-note2"></i>
                    Requerimientos
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li class="{{ request()->is('misrequerimientos') ? 'mm-active' : '' }}">
                        <a href="{{ url('misrequerimientos') }}">
                            <i class="metismenu-icon">
                            </i>Mis requerimientos
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('Requerimientoss.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('Requerimientoss.index') }}">
                            <i class="metismenu-icon">
                            </i> Gestion
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('requerimientos_dashboard.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('requerimientos_dashboard.index') }}">
                            <i class="metismenu-icon">
                            </i>Indicadores
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-user"></i>
                    Gestion de terceros
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li class="{{ request()->route()->named('GestionClientes.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('GestionClientes.index') }}">
                            <i class="metismenu-icon">
                            </i>Clientes
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->route()->named('pronosticos.index') ? 'mm-active' : '' }}">
                <a href="{{ route('pronosticos.index') }}">
                    <i class="metismenu-icon  pe-7s-umbrella"></i>
                    Pronosticos
                </a>
            </li>
            <li class="app-sidebar__heading">Blog</li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-news-paper"></i>
                    Publicaciones
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li class="{{ request()->route()->named('posts.create') ? 'mm-active' : '' }}">
                        <a href="{{ route('posts.create') }}">
                            <i class="metismenu-icon">
                            </i>Crear publicacion
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('posts.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('posts.index') }}">
                            <i class="metismenu-icon">
                            </i>Mostrar Publicaciones
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-folder"></i>
                    Categorias
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li class="{{ request()->route()->named('categories.create') ? 'mm-active' : '' }}">
                        <a href="{{ route('categories.create') }}">
                            <i class="metismenu-icon">
                            </i>Crear categoria
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('categories.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('categories.index') }}">
                            <i class="metismenu-icon">
                            </i>Mostrar categorias
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-ticket"></i>
                    Etiquetas
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li class="{{ request()->route()->named('tags.create') ? 'mm-active' : '' }}">
                        <a href="{{ route('tags.create') }}">
                            <i class="metismenu-icon">
                            </i>Crear etiqueta
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('tags.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('tags.index') }}">
                            <i class="metismenu-icon">
                            </i>Mostrar etiquetas
                        </a>
                    </li>
                </ul>
            </li>


            <li class="app-sidebar__heading">Administracion</li>
            <li class="{{ request()->route()->named('users.index') ? 'mm-active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <i class="metismenu-icon pe-7s-user">
                    </i>Usuarios
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-unlock">
                    </i>Roles
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li class="{{ request()->route()->named('roles.create') ? 'mm-active' : '' }}">
                        <a href="{{ route('roles.create') }}">
                            <i class="metismenu-icon">
                            </i>Crear rol
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('roles.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('roles.index') }}">
                            <i class="metismenu-icon">
                            </i>Mostrar roles
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-key">
                    </i>Permisos
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li class="{{ request()->route()->named('permissions.create') ? 'mm-active' : '' }}">
                        <a href="{{ route('permissions.create') }}">
                            <i class="metismenu-icon">
                            </i>Crear permiso
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('permissions.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('permissions.index') }}">
                            <i class="metismenu-icon">
                            </i>Mostrar permisos
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('permission_groups.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('permission_groups.index') }}">
                            <i class="metismenu-icon">
                            </i>Grupos de permisos
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('permission_groups.create') ? 'mm-active' : '' }}">
                        <a href="{{ route('permission_groups.create') }}">
                            <i class="metismenu-icon">
                            </i>Crear grupo de permisos
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->route()->named('backup.index') ? 'mm-active' : '' }}">
                <a href="{{ route('backup.index') }}">
                    <i class="metismenu-icon pe-7s-server">
                    </i>Backups
                </a>
            </li>
            <li class="{{ request()->is('logs') ? 'mm-active' : '' }}">
                <a href="{{ url('logs') }}">
                    <i class="metismenu-icon pe-7s-video">
                    </i>Logs
                </a>
            </li>
        </ul>
    </div>
</div>
