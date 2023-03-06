		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('adminbackend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">{{auth()->user()->name}}</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{route('admin.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-user'></i>
						</div>
						<div class="menu-title">Usuarios</div>
					</a>
					<ul>
						<li> <a href="{{route('admin.register')}}"><i class="bx bx-right-arrow-alt"></i>Registrar nuevo</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Software</div>
					</a>
					<ul>
						<li> <a href="{{route('generar-cortes')}}"><i class="bx bx-right-arrow-alt"></i>Generar Cortes</a>
						</li>
						<li> <a href="{{route('generar-active')}}"><i class="bx bx-right-arrow-alt"></i>Generar Activación</a>
						</li>
					</ul>
				</li>
				<li class="menu-label">Perfil</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cog'></i>
						</div>
						<div class="menu-title">{{auth()->user()->name}}</div>
					</a>
					<ul>
						<li> <a href="{{route('admin.profile')}}"><i class="bx bx-right-arrow-alt"></i>Perfil</a>
						</li>
						<li> <a href="{{route('admin.change.password')}}"><i class="bx bx-right-arrow-alt"></i>Cambiar contraseña</a>
						</li>
					</ul>
				</li>
			</ul>
			<!--end navigation--> 
		</div>
		<!--end sidebar wrapper -->