<form action="{{ url()->current() }}">
		<div class="row">
	 
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
				<input type="text" class="form-control mt-2 daterangepicker-lib" value="{{ request('paid_at') }}" name="paid_at" placeholder="Payment Date" />
			</div>

			<div class="col-md-12"></div>
 
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
					'name' => 'card_type', 
					'label' => '', 
					'value' => '', 
					'placeholder' => '', 
					'textareaSelectLabel' => 'Payment Type',
					'selected'=> request('card_type'),
					'list' => [
	                '' => 'All',
	                'CBPAY' => 'CBPAY',
	                'MPU' => 'MPU',
	                'MASTERCARD' => 'MASTERCARD',
	                'VISA' => 'VISA',
	                'JCB' => 'JCB',
	                'DISCOVER' => 'DISCOVER',
	             ]]" />
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