<form action="{{ url()->current() }}">
		<div class="row">
			<!-- ---------------------->
			<input type="hidden" name="actionOperation" value="{{ request('actionOperation', 'search') }}" class="form-actionOperation" />
			<!---------------------- -->
			<input type="hidden" name="page" value="{{ request('page') }}" />


			<div class="col-md-4">
				<input type="text" class="form-control mt-2" value="{{ request('manufacturer_name') }}" name="manufacturer_name" placeholder="Factory Name" />
			</div>

			<div class="col-md-4">
				<input type="text" class="form-control mt-2" value="{{ request('dosage_type') }}" name="dosage_type" placeholder="Dosage Form Type" />
			</div>

			<div class="col-md-4">
				<input type="text" class="form-control mt-2" value="{{ request('application_no') }}" name="application_no" placeholder="Application No." />
			</div>

			<div class="col-md-4">
				<input type="text" class="form-control mt-2" value="{{ request('certificate_no') }}" name="certificate_no" placeholder="Certificate No." />
			</div>

			<div class="col-md-4">
				<input type="text" class="form-control mt-2 daterangepicker-lib" value="{{ request('submitted_at') }}" name="submitted_at" placeholder="Application Date" />
			</div>

			<div class="col-md-4">
				<input type="text" class="form-control mt-2 daterangepicker-lib" value="{{ request('resubmitted_at') }}" name="resubmitted_at" placeholder="Resubmission Date" />
			</div>

			<div class="col-md-4">
				<input type="text" class="form-control mt-2 daterangepicker-lib" value="{{ request('incomplete_at') }}" name="incomplete_at" placeholder="Incomplete Date" />
			</div>

			<div class="col-md-4">
				<input type="text" class="form-control mt-2 daterangepicker-lib" value="{{ request('auto_cancelled_at') }}" name="auto_cancelled_at" placeholder="Auto Cancelled Date" />
			</div>

			<div class="col-md-4">
				<input type="text" class="form-control mt-2 daterangepicker-lib" value="{{ request('rejected_at') }}" name="rejected_at" placeholder="Rejected Date" />
			</div> 	

			<div class="col-md-4">
				<input type="text" class="form-control mt-2 daterangepicker-lib" value="{{ request('approved_at') }}" name="approved_at" placeholder="Approved Date" />
			</div>

			<div class="col-md-4">
				<input type="text" class="form-control mt-2 daterangepicker-lib" value="{{ request('issue_date') }}" name="issue_date" placeholder="Issue Date" />
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control mt-2 daterangepicker-lib" value="{{ request('expire_date') }}" name="expire_date" placeholder="Expiry Date" />
			</div> 	
 
			<div class="col-md-3">
				<x-forms.select-with-value-value :attrs="[
					'name' => 'application_type', 
					'label' => '', 
					'value' => '', 
					'textareaSelectLabel' => 'Application Type',
					'placeholder' => '', 
					'selected'=> request('application_type'),
					'list' => ['New', 'Renew', 'Amend']]" />
			</div>
			<!-- 'draft','submitted','resubmitted','incomplete','auto-cancelled','accepted','rejected','under-assessment','finalized','trash','withdrawn','approved' -->
			<div class="col-md-3">
				<x-forms.select-with-key-value :attrs="[
					'name' => 'application_status', 
					'label' => '', 
					'value' => '', 
					'placeholder' => '', 
					'textareaSelectLabel' => 'Application Status',
					'selected'=> request('application_status'),
					'list' => [ 
						'submitted' => 'Submitted', 
						'resubmitted' => 'Resubmitted', 
						'incomplete' => 'Incomplete', 
						'auto-cancelled' => 'Auto Cancelled', 
						'rejected' => 'Rejected', 
						'approved' => 'Approved']
					]" />
			</div>

			<div class="col-md-3">
				<x-forms.select-with-key-value :attrs="[
					'name' => 'order_by', 
					'label' => '',  
					'placeholder' => '', 
					'textareaSelectLabel' => 'Sort By',
					'selected'=> request('order_by'),
					'list' => [ 
						'application_no' => 'Application No.', 
						'certificate_no' => 'Certificate No.'
						]
					]" />
			</div>

			<div class="col-md-3">
				<x-forms.select-with-key-value :attrs="[
					'name' => 'direction', 
					'label' => '',  
					'placeholder' => '', 
					'textareaSelectLabel' => '',
					'selected'=> request('direction', 'asc'),
					'list' => [ 
						'asc' => 'ASC', 
						'desc' => 'DESC'
						]
					]" />
			</div>
 
			<div class="col-md-12 mt-4 mb-5 text-right">
				<button type="submit" class="btn btn-success form-action-btn" name="action" value="report">
					<i class="fa fa-file-excel-o" aria-hidden="true" ></i> Report
				</button>
				<button type="submit" class="btn btn-primary form-action-btn" name="action" value="search">Search</button>
				<a href="{{ url()->current() }}" class="btn btn-danger no-alert">Clear</a>
			</div> 
		</div>
	</form>