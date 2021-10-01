@include('header')
@include('sideuser')


				<div class="span9">
					<div class="content">

						

						<div class="module">
							<div class="module-head">
								<h3>Select BOL XML File</h3>
	                        	<!-- <form action="fileuploads" method="post" enctype="multipart/form-data"> -->
	                        	<form action="fileuploads" method="post" enctype="multipart/form-data">
	                        			@csrf
									<label>Select a file:</label>
																			
									<select name="Termina" id="Termina">
									  @foreach ($newallTerminas as $newallTerminas)
										  <option value="{{ $newallTerminas->TerminalCode }}">{{ $newallTerminas->TerminalName }}</option>
									  @endforeach
									</select><br>
									<input type="file" name="myfiles[]" multiple>
									<button type="submit" class="btn btn-primaryBlack pull-right" disabled>Export to Nimasa</button>
								</form>
								@if(Session::has('error'))
								    <p class="alert alert-danger">{{ Session::get('error') }}</p>
								@endif
								@if(Session::has('success'))
								    <p class="alert alert-success">{{ Session::get('success') }}</p>
								@endif
								@if(Session::has('bolrerror'))
								    <p class="alert alert-danger">{{ Session::get('bolrerror') }}</p>
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

<script type="text/javascript">
	$('input[type=file]').change(function(){
    if($('input[type=file]').val()==''){
        $('button').attr('disabled',true)
    } 
    else{
      $('button').attr('disabled',false);
    }
})
</script>
