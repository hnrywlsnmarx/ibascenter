		<!-- main-header opened -->
		<div class="main-header nav nav-item hor-header">
			<div class="container">
				<div class="main-header-left ">
					<a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a><!-- sidebar-toggle-->
					<a class="header-brand" href="{{url('/')}}">
						
						
					</a>
				</div><!-- search -->
				<div class="main-header-right">
					<div class="nav nav-item  navbar-nav-right ml-auto">
						<div class="nav-link" id="bs-example-navbar-collapse-1">
							<form class="navbar-form" role="search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search">
									<span class="input-group-btn">
										<button type="reset" class="btn btn-default">
											<i class="fas fa-times"></i>
										</button>
										<button type="submit" class="btn btn-default nav-link resp-btn">
											<i class="fe fe-search"></i>
										</button>
									</span>
								</div>
							</form>
						</div>
						<div class="main-header-search ml-5 d-sm-none d-none d-lg-block">
							<!-- <input class="form-control shadow" id="search-input" placeholder="Search for anything..." type="text"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button> -->
						</div>
							 {{-- notif header place here --}}
						{{-- <div class="dropdown main-profile-menu nav nav-item nav-link"> --}}
							{{-- <a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}">
								<div class="p-text d-none">
									<span class="p-name font-weight-bold">{{ session('nama') }}</span>
									<small class="p-sub-text">{{ session('role') }}</small>
								</div> --}}
								<a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i><b> Sign Out</b> </a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
							</a>
							{{-- <div class="dropdown-menu">
								<div class="main-header-profile header-img">
									<div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"></div>
									<h6>{{ session('nama') }}</h6><span>{{ session('role') }}</span><span>{{ session('branch') }}</span>
								</div> --}}
								{{-- <a class="dropdown-item" href=""><i class="far fa-user"></i> My Profile</a>
								<a class="dropdown-item" href=""><i class="far fa-edit"></i> Edit Profile</a>
								<a class="dropdown-item" href=""><i class="far fa-clock"></i> Activity Logs</a>--}}
								{{-- <a class="dropdown-item" href=""><i class="fas fa-sliders-h"></i> Change Password</a>  --}}
								<!-- <a class="dropdown-item" href="{{url('signin')}}"><i class="fas fa-sign-out-alt"></i> Sign Out</a> -->
									
							{{-- </div> --}}
						{{-- </div> --}}
						{{-- <div class="dropdown main-header-message right-toggle">
							<a class="nav-link pr-0" data-toggle="sidebar-right" data-target=".sidebar-right">
								<i class="ion ion-md-menu tx-20 bg-transparent"></i>
							</a>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
		<!-- main-header closed -->