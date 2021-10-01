@include('header')
@include('side')


				<div class="span9">
					<div class="content">
						<div class="module">
							<div class="module-head">
								<h3>LIST OF TERMINAL AND THEIR TERMINAL CODE</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Termina Name</th>
											<th>Termina Code</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($newallTerminas as $newallTerminas)
										<tr class="odd gradeX">
											<td>{{ $newallTerminas->TerminalName }}</td>
											<td>{{ $newallTerminas->TerminalCode }}</td>
											<td><a href="/delterm/{{$newallTerminas->id }}"><i class="menu-icon icon-trash"></i></a></td>
										@endforeach
									</tbody>
								</table> 
								@if (\Session::has('success'))
								    <div class="alert alert-success">
								        <ul>
								            <li>{!! \Session::get('success') !!}</li>
								        </ul>
								    </div>
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