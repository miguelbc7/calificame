<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->company }}</p>
                    <!-- Status -->
                    <!--<a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>-->
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Inicio</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('admin') }}"><i class='fa fa-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            @if(Session::get('status') == 1)
            <li class="treeview">
                <a href="#"><i class='fa fa-cog'></i> <span>Data</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                   <li><a href="{{ url('surveys') }}">Encuestas</a></li>
                    @if(Session::get('utype') == 1)
                        <li><a href="{{ url('questions') }}">Preguntas</a></li>
                    @endif
                </ul>
            </li>
            @elseif(Session::get('status') == 2)
            <li><a href="{{ url('renew') }}"><i class="fa fa-link"></i> <span>Renovar</span></a></li>
            @endif
            @if(Session::get('utype') == 1)
            <li><a href="{{ url('users') }}"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>
            <li><a href="{{ url('socialnetworks/1/edit') }}"><i class="fa fa-share-square-o"></i><span>Redes Sociales</span></a></li>
            @endif
            <li><a href="{{ url('emails') }}"><i class="fa fa-envelope-o"></i> <span>Correos</span></a></li>
            <li><a href="{{ url('waiters') }}"><i class="fa fa-address-card-o"></i> <span>Meseros</span></a></li>
            <li><a href="{{ url('support') }}"><i class="fa fa-phone"></i> <span>Soporte</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
