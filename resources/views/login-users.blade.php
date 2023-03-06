
    @include('form.header')
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<img src="{{asset('adminbackend/')}}assets/images/logo-img.png" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center mb-3">
										<h3 class="">Inicía Sesión</h3>
									</div>

									<div class="form-body">
                                        <form class="row g-3" method="POST" action="{{ route('login') }}">
                                            @csrf
											<div class="col-12">
												<label for="username" class="form-label">Username:</label>
												<input type="text" name="username" class="form-control" id="username" placeholder="Your username">
                                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                            </div>
											<div class="col-12">
												<label for="password" class="form-label">Contraseña:</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" name="password" class="form-control border-end-0" id="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                </div>
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
													<label class="form-check-label" for="flexSwitchCheckChecked">Recordarme</label>
												</div>
											</div>
											<div class="col-md-6 text-end">	<a href="#">Olvidaste tu contraseña?</a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Ingresar</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
@include('form.footer')