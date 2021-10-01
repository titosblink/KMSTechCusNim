@include('header')
@include('side')


				<div class="span9">
					<div class="content">

						

						<div class="module">
							<div class="module-head">
								<h3>Select Manifest XML File</h3>
	                        	<!-- <form action="fileuploads" method="post" enctype="multipart/form-data"> -->
	                        	<form action="manfileuploads" method="post" enctype="multipart/form-data">
	                        			@csrf
	                        		<label>Select a file:</label>
									<!-- <input type="number" name="NoBol" placeholder="No of BOL"><br>					
									<input type="number" name="NoCont" placeholder="No of Container"><br>					
									<input type="number" name="NoPack" placeholder="No of Packages"><br> -->					
									<input type="number" name="TotGross" placeholder="Total Gross " min="0" value="0" step="0.000001"><br>					
									<select name="Termina" id="Termina">
									  @foreach ($newallTerminas as $newallTerminas)
										  <option value="{{ $newallTerminas->TerminalCode }}">{{ $newallTerminas->TerminalName }}</option>
									  @endforeach
									</select><br>
									
									<input type="file" name="myfiles[]" multiple>
									<button type="submit" class="btn btn-primaryBlack pull-right" disabled="">Export to Nimasa</button>
									@if(Session::has('manerror'))
								    <p class="alert alert-danger">{{ Session::get('manerror') }}</p>
								@endif
								</form>
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
