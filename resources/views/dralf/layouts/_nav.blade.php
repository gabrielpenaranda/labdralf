{{-- <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand pw-logo" href="{{ url('/dralf') }}">
                <img src="{{ asset('img/logo-100.png') }}" alt="LabDrAlf">
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Base <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-item"><a href="{{ route('tipopersonas.index') }}">Tipo de Persona</a></li>
                        <li class="dropdown-item"><a href="{{ route('unidadmedidas.index') }}">Unidad de Medida</a></li>
                         <li class="dropdown-item"><a href="{{ route('tipoproductos.index') }}">Tipo de Persona</a></li>
                        <li class="dropdown-item"><a href="{{ route('ciudades.index') }}">Ciudad</a></li>
                        <li class="dropdown-item"><a href="{{ route('estados.index') }}">Estado</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Terceros <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('terceros.index') }}">Terceros</a></li>
                        <li class="dropdown-item"><a href="{{ route('personas.index') }}">Personas</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Inventario <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('productos.index') }}">Productos</a></li>
                        <li class="dropdown-item"><a href="">Materia Prima</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Producción <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-item"><a href="{{ route('lotes.index') }}">Lotes</a></li>
                        <li class="dropdown-item"><a href="{{ route('pruebaanticoagulantes.index') }}">Pruebas Anticuagulantes</a></li>
                        <li class="dropdown-item"><a href="{{ route('pruebadiluentes.index') }}">Pruebas Diluentes</a></li>
                        <li class="dropdown-item"><a href="{{ route('pruebalisantes.index') }}">Pruebas Lisantes</a></li>
                        <li class="dropdown-item"><a href="">Pruebas Rinses</a></li>
                        <li class="dropdown-item"><a href="">Formulas</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ventas <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-item"><a href="{{ route('facturas.index', ['modulo' => 'factura']) }}">Facturas</a></li>
                            <li class="dropdown-item"><a href="{{ route('notaentrega.index', ['modulo' => 'notaentrega']) }}">Notas de Entrega</a></li>
                            <li class="dropdown-item"><a href="{{ route('reportefactura.index') }} ">Reportes</a></li>
                        </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cobros <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-item"><a href="{{ route('cobros.index', ['modulo' => 'nocancel']) }}">Registro</a></li>
                        <li class="dropdown-item"><a href="{{ route('cobros.facturas-canceladas', ['modulo' => 'cancel']) }}">Facturas Canceladas</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ url('/dralf') }}"><img src="{{ asset('img/logo-100.png') }}" alt="LabDrAlf"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="baseDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Base
        </a>
        <div class="dropdown-menu" aria-labelledby="baseDropdown">
          <a class="dropdown-item" href="{{ route('tipopersonas.index') }}">Tipo de Persona</a>
          <a class="dropdown-item" href="{{ route('unidadmedidas.index') }}">Unidad de Medida</a>
          <a class="dropdown-item" href="{{ route('tipoproductos.index') }}">Tipo de Producto</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('ciudades.index') }}">Ciudad</a>
          <a class="dropdown-item" href="{{ route('estados.index') }}">Estado</a>
        </div>
      </li>

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="terceroDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Terceros
        </a>
        <div class="dropdown-menu" aria-labelledby="terceroDropdown">
          <a class="dropdown-item" href="{{ route('terceros.index') }}">Terceros</a>
          <a class="dropdown-item" href="{{ route('personas.index') }}">Personas</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="inventarioDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inventario
        </a>
        <div class="dropdown-menu" aria-labelledby="inventarioDropdown">
          <a class="dropdown-item" href="{{ route('terceros.index') }}">Productos</a>
          <a class="dropdown-item" href="">Materia Prima</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="produccionDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Producción
        </a>
        <div class="dropdown-menu" aria-labelledby="produccionDropdown">
          <a class="dropdown-item" href="{{ route('lotes.index') }}">Lotes</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('pruebaanticoagulantes.index') }}">Pruebas Anticuagulantes</a>
          <a class="dropdown-item" href="{{ route('pruebadiluentes.index') }}">Pruebas Diluentes</a>
          <a class="dropdown-item" href="{{ route('pruebalisantes.index') }}">Pruebas Lisantes</a>
          <a class="dropdown-item" href="">Pruebas Rinses</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="">Formulas</a>
        </div>
      </li>

      {{-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="ventasDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ventas
        </a>
        <div class="dropdown-menu" aria-labelledby="ventasDropdown">
          <a class="dropdown-item" href="{{ route('facturas.index', ['modulo' => 'factura']) }}">Facturas</a>
          <a class="dropdown-item" href="{{ route('notaentrega.index', ['modulo' => 'notaentrega']) }}">Notas de Entrega</a>
          <a class="dropdown-item" href="{{ route('reportefactura.index') }} ">Reportes</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="cobrosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cobros
        </a>
        <div class="dropdown-menu" aria-labelledby="cobrosDropdown">
          <a class="dropdown-item" href="{{ route('cobros.index', ['modulo' => 'nocancel']) }}">Registro</a>
          <a class="dropdown-item" href="{{ route('cobros.facturas-canceladas', ['modulo' => 'cancel']) }}">Facturas Canceladas</a>
        </div>
      </li> --}}


    </ul>
    <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Salir
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
  </div>
</nav>










{{-- <nav class="navbar is-dark is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="{{ url('/dralf') }}">
      <img src="{{ asset('img/logo-100.png') }}" alt="LabDrAlf" width="112" height="28">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless">
         Base
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="{{ route('tipopersonas.index') }}">
            Tipo de persona
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item" href="{{ route('unidadmedidas.index') }}">
            Unidad de medida
          </a>
          <a class="navbar-item" href="{{ route('tipoproductos.index') }}">
            Tipo de producto
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item" href="{{ route('ciudades.index') }}">
            Ciudad
          </a>
          <a class="navbar-item" href="{{ route('estados.index') }}">
            Estado
          </a>
        </div>
      </div>

       <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless">
         Terceros
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="{{ route('terceros.index') }}">
            Terceros
          </a>
          <a class="navbar-item" href="{{ route('personas.index') }}">
            Personas
          </a>
        </div>
      </div>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless">
         Inventario
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="{{ route('productos.index') }}">
            Productos
          </a>
          <a class="navbar-item" href="{{ route('materiaprimas.index') }}">
            Materia Prima
          </a>
        </div>
      </div>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless">
         Producción
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="">
            Formulas
          </a>
          <a class="navbar-item" href="{{ route('lotes.index') }}">
            Lotes
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item" href="{{ route('pruebaanticoagulantes.index') }}">
            Pruebas anticuagulantes
          </a>
          <a class="navbar-item" href="{{ route('pruebadiluentes.index') }}">
            Pruebas diluentes
          </a>
          <a class="navbar-item" href="{{ route('pruebalisantes.index') }}">
            Pruebas lisantes
          </a>
          <a class="navbar-item" href="{{ route('pruebarinses.index') }}">
            Pruebas rinses
          </a>
        </div>
      </div>

    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-danger" href="{{ route('logout') }}" onclick="event.preventDefault();       document.getElementById('logout-form').submit();">
            <strong>Salir</strong>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>
</nav> --}}
