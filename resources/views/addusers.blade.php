@include('header')
@include('side')


				<div class="span9">
					<div class="content">

						

						<div class="module">
							<div class="module-head">
								<h3>ADD USER</h3>
	                        	<!-- <form action="fileuploads" method="post" enctype="multipart/form-data"> -->
	                        	<form action="adduse" method="post" enctype="multipart/form-data">
	                        			@csrf																								
									<input type="text" name="uname" id="uname" placeholder="User Name"><br>
									<input type="text" name="fname" id="fname" placeholder="Fullname"><br>								
									<input type="email" name="email" id="email" placeholder="E-Mail"><br>	
									<select name="rights">
										<option value="admin">Admin</option>
										<option value="user">User</option>
									</select>							
									<button type="submit" class="btn btn-primaryBlack pull-right">Add User</button>
									<br>
								</form>
								@if(Session::has('error'))
								    <p class="alert alert-danger">{{ Session::get('error') }}</p>
								@endif
								@if(Session::has('success'))
								    <p class="alert alert-success">{{ Session::get('success') }}</p>
								@endif
							</div>
							
						</div><!--/.module-->

					<br />
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
            <b class="copyright">&copy; {{ date('Y') }} MSC -   All rights reserved | Powered by KMS-Tech Solutions </b>
        </div>
	</div>

	<script src="scripts/jquery-1.9.1.min.js"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>


