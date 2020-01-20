	            <div class="card">
	            	<div class="card-header">
	                    <h5>Service Subscriptions</h5>
	                </div>
	                <div class="card-block">
	                	<table class="table table-sm" id="itemtable">
                             <thead>
                                 <tr>
                                    <th width="40%" style="padding: 0.6rem 1rem">Subscriptions</th>
                                    <th width="5%" style="padding: 0.6rem 1rem">Start Date</th>
                                    <th width="5%" style="padding: 0.6rem 1rem">End Date</th>
                                    <th width="10%" style="padding: 0.6rem 1rem">Monthly Amount</th>
                                    {{-- <th width="10%">Daily Amount</th> --}}
                                    <th width="5%" style="padding: 0.6rem 1rem">
                                    	<a href="#" id="addrow">
                                    		<button class="btn waves-effect waves-light btn-success btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;">
	                                        <i class="fa fa-plus"></i>
	                                    	</button>
                                    	</a>
                                    </th>
                                 </tr>
                             </thead>
                             <tbody>
                               <tr>
                                <td style="padding: 0.6rem 1rem">
                                  <select name="subscriptions[]" class="js-example-basic-single" style="width:100%;">
                                    <option disabled selected value>Select Service(s)</option>
                                      @foreach ($services->where('is_subscription', true) as $subscription)
                                        <option value="{{ $subscription->id }}">{{ $subscription->name }} ({{ currencysign($subscription->amount) }})</option>
                                      @endforeach
                                  </select>
                                </td>
                                <td style="padding: 0.6rem 1rem">
                                	<div class="input-group">
	                                    <input type="date" name="start[]" class="form-control">
	                                </div>
                                </td>
                                <td style="padding: 0.6rem 1rem">
                                	<div class="input-group">
	                                    <input type="date" name="end[]" class="form-control">
	                                </div>
                                </td>
                                <td style="padding: 0.6rem 1rem">
                                	<div class="input-group">
	                                    <span class="input-group-prepend">
	                                        <label class="input-group-text">{{ config('pms.currency.sign') }}</label>
	                                    </span>
	                                    <input type="number" min="1" step="any" name="amounts[]" class="form-control {{-- autonumber fill --}}" data-a-sign="{{ config('pms.currency.sign') }}">
	                                </div>
                                </td>
                                <td style="padding: 0.6rem 1rem">
                                	<a href="#" id="btnDel">
                                		<button class="btn waves-effect waves-light btn-danger btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;">
	                                        <i class="fa fa-minus"></i>
	                                    </button>
                                    </a>
                                </td>
                               </tr>
                             </tbody>
                          </table>
	                </div>
	            </div>

@section('js-plugin')
    @include('includes.plugins.select-js')
    @include('includes.plugins.formmasking-js')
    @include('includes.plugins.formpicker-js')
    @include('includes.custom-scripts.multi-subscriptions')
@endsection