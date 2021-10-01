<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="span3">
					<div class="sidebar">

						<ul class="widget widget-menu unstyled">
							<li class="active">
								<a href="{{URL::asset('dashboard')}}">
									<i class="menu-icon icon-dashboard"></i>
									View Terminal Record
								</a>
							</li>
							<li>
								<a href="{{URL::asset('uploadpage')}}">
									<i class="menu-icon icon-upload"></i>
									Export BOL Files
								</a>
							</li>
							<li>
								<a href="{{URL::asset('uploadmanifest')}}">
									<i class="menu-icon icon-upload"></i>
									Export Manifest Files
								</a>
							</li>
							<li>
								<a href="{{URL::asset('addterminal')}}">
									<i class="menu-icon icon-upload"></i>
									Add Terminal
								</a>
							</li>
							<li>
								<a href="{{URL::asset('adduser')}}">
									<i class="menu-icon icon-upload"></i>
									Add User
								</a>
							</li>
							<li>
								<a href="{{URL::asset('changepwd')}}">
									<i class="menu-icon icon-upload"></i>
									Change password
								</a>
							</li>
						</ul><!--/.widget-nav-->

						
						<ul class="widget widget-menu unstyled">
							
							
							<li>
								<a href="#">
									<i class="menu-icon icon-signout"></i>
									<form action="logout" method="post" enctype="multipart/form-data">
										@csrf
										<button type="submit">Logout</button> 
									</form>
								</a>
							</li>
						</ul>

					</div><!--/.sidebar-->
				</div><!--/.span3-->