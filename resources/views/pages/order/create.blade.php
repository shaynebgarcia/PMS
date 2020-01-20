@extends('layouts.admindek', ['pageSlug' => 'order-create'])

@section('css-plugin')
    @include('includes.plugins.select-css')
    @include('includes.plugins.formmasking-css')
    @include('includes.plugins.formpicker-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.order.icon');
        $breadcrumb_title = config('pms.breadcrumbs.order.order-create.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.order.order-create.subtitle');
    @endphp
    {{ Breadcrumbs::render('order-create') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
        	<form name="order-store" id="order-store" method="POST" action="{{ route('orders.store') }}">
	        @CSRF
	        </form>
	            <div class="card">
	                <div class="card-header">
	                    <h5>Leasing Agreement</h5>
	                </div>
	                <div class="card-block">
	                    <!-- {{-- SELECT Agreement --}} -->
	                    <div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Leasing Agreement*</label>
	                            <div class="col-lg-10 col-md-10 col-sm-10">
	                                <select class="select2" name="agreement" id="agreement_id" form="order-store" style="width: 100%">
	                                    <option value="#" disabled selected>Select an a Agreement</option>
	                                    @foreach($leases as $lease)
                                            <option value="{{ $lease->details->last()->id }}">
                                                {{ $lease->details->last()->agreement_no }} | UNIT: {{ $lease->unit->number }} | TENANT(S): @foreach($lease->tenant_list as $tl)
                                                	{{ $tl->tenant->user->lnamefname }},
                                                	@if ($loop->last)
                                                		{{ $tl->tenant->user->lnamefname }}
                                                	@endif
                                                @endforeach
                                             	| {{ $lease->details->last()->term_start  }} ({{ $lease->details->last()->status->title }})
                                            </option>
                                        @endforeach
	                                </select>
	                                @error('agreement')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
	                            </div>
	                    </div>
	                </div>
	            </div>

	            <div class="card">
	            	<div class="card-header">
	                    <h5>Order Details</h5>
	                </div>
	                <div class="card-block">
	                	<div class="form-group row">
	                		<label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Order Type</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                            	<select class="select2" name="order_type" form="order-store" style="width: 100%" required>
	                                    <option value="#" disabled selected>Select a type</option>
	                                    @foreach($order_types as $type)
	                                    	<option value="{{ $type->id }}">
	                                    		{{ $type->name }}
	                                    	</option>
	                                    @endforeach
	                                </select>
	                                @error('order_type')
	                                    <span class="messages">
	                                        <p class="text-danger error">{{ $message }}</p>
	                                    </span>
	                                @enderror
	                            </div>
                		</div>
                		<div class="form-group row">
	                		<label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Description</label>
	                            <div class="col-lg-10 col-md-10 col-sm-10">
	                            	<input type="text" class="form-control" name="description" value="" form="order-store">
	                                @error('description')
	                                    <span class="messages">
	                                        <p class="text-danger error">{{ $message }}</p>
	                                    </span>
	                                @enderror
	                            </div>
                		</div>
                		<div class="form-group row">
	                		<label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Notes</label>
	                            <div class="col-lg-10 col-md-10 col-sm-10">
	                            	<textarea class="form-control" name="notes" value="" form="order-store"></textarea>
	                                @error('notes')
	                                    <span class="messages">
	                                        <p class="text-danger error">{{ $message }}</p>
	                                    </span>
	                                @enderror
	                            </div>
                		</div>
	                	<div class="form-group row">
	                		<label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Month to Bill*</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                            	<select class="select2" name="to_bill" id="to_bill" form="order-store" style="width: 100%" required>
	                                    <option value="#" disabled selected>Select an agreement first</option>
	                                </select>
	                                @error('to_bill')
	                                    <span class="messages">
	                                        <p class="text-danger error">{{ $message }}</p>
	                                    </span>
	                                @enderror
	                            </div>
                		</div>
	                </div>
	            </div>

	            <div class="card">
	            	<div class="card-header">
	                    <h5>Inventory</h5>
	                </div>
	                <div class="card-block">
	                	<form name="ProcessItem" id="ProcessItem">
		                	@CSRF
		                 </form>
	                	<div class="form-group row">
	                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Inventory Item</label>
	                            <div class="col-lg-10 col-md-10 col-sm-10">
	                                <select class="select2" name="item" id="item_id" style="width: 100%" form="ProcessItem">
	                                    <option value="#" disabled selected>Select an Item</option>
	                                    @foreach($inventories as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->code }} | {{ $item->description }}
                                            </option>
                                        @endforeach
	                                </select>
	                            </div>
	                    </div>
	                    <div class="form-group row">
	                    	<label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Available Stock</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                            	<input type="number" class="form-control" name="stock" id="stock_id" value="" form="ProcessItem" readonly>
	                            </div>
	                    </div>
	                    <div class="form-group row">
	                    	<label class="col-lg-2 col-md-2 col-sm-2 col-form-label">QTY</label>
	                            <div class="col-lg-4 col-md-4 col-sm-4">
	                            	<input type="number" class="form-control" name="qty" id="qty_id" value="" form="ProcessItem">
	                            </div>
	                            <div class="col-lg-2 col-md-2 col-sm-2">
		                    		<button type="submit" value="Submit" name="btnProcessItem" form="ProcessItem" id="btnProcessItem" class="btn waves-effect waves-light btn-primary btn-sm">Process Item</button>
		                    	</div>
	                    </div>
	                </div>
	            </div>

	            <div class="card">
	            	<div class="card-header">
	            		<h5>Processing</h5>
	            	</div>
	            	<div class="card-block">
	            		<form id="RemoveProcess">
                          @CSRF
                          @METHOD('DELETE')
                          {{-- <a href="/exportProcessing">
                          	<button type="button" class="btn btn-outline-primary btn-sm">Print</button>
                          </a> --}}
                          <button type="submit" value="Submit" class="btn btn-outline-warning btn-sm">CLEAR</button>
                        </form>
                        <div class="m-t-10" id="ProcessList">
                        </div>
	            	</div>
	            </div>

                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                        <button type="submit" form="order-store" class="btn waves-effect waves-light btn-primary btn-block btn-round">Submit</button>
                    </div>
                </div>
 
        </div>
    </div>
@endsection

@section('js-plugin')
    @include('includes.plugins.select-js')
    @include('includes.plugins.formmasking-js')
    @include('includes.plugins.formpicker-js')

    <script type="text/javascript">
	  $(document).ready(function(){
	    /*$("[type='number']").keypress(function (evt) {
	        evt.preventDefault();
	    });*/
	    $("#agreement_id").on('change',function () {
	      GETTermDuration();
	      console.log($("#agreement_id").val());
	    });
	    $("#item_id").on('change',function () {
	      QTYRefresh();
	    });
	  });
	</script>

	<script type="text/javascript">
	  $(document).ready(function(){
	    $.ajaxSetup({
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });

	    $('#ProcessItem').on('submit', function (e) {
	      e.preventDefault();
	      if ($('#qty_id').val() <= 0){
	        swal({
	            title: 'Oops!',
	            text: 'Cannot process item with a quantity count that is less than 1, please try again.',
	            icon: 'warning',
	            });
	      }
	      else {
	        FormProcessItem();
	      }
	    });

	    $('#RemoveProcess').on('submit', function (e) {
	      e.preventDefault();
	        swal({
	          title: 'Are you sure?',
	          text: 'All field will be removed and the following item(s) will be tagged as available',
	          icon: 'warning',
	          buttons: {
	            delete: {
	              text: "Yes, I want to clear this",
	              value: "Clear",
	            },
	            cancel: "Cancel"
	          },
	        })
	        .then((value) => {
	          switch (value) {
	            case "Clear":
	              FormRemoveProcess();
	            swal("Cleared!", "Processing item(s) were succesfully cleared", "success");
	            break;

	            default:
	            swal("Clear cancelled");
	          }
	        });
	    });
	  });

	  ReadProcessing();

	  	function GETTermDuration() {
			var agreement_id=$('#agreement_id').val();
			$.ajax({
				type:'GET',
				url:'{!!URL::to('getTerm')!!}',
				data:{'id':agreement_id},
				dataType:'json',
				success:function(data){
					$('#to_bill').html(data);
				}
			});
		}

	  function FormProcessItem() {
	      var item_id = $('#item_id').val();
	      var qty = $('#qty_id').val();
	        $.ajax({
	          url: '{!!URL::to('process')!!}',
	          type: 'POST',
	          data: {'item_id':item_id, 'qty':qty, '_token': $('input[name=_token]').val() } ,
	          success: function (data) {
	            swal({
	              title: 'Processed!',
	              text: 'Item successfully processed',
	              icon: 'success',
	              });
	            ReadProcessing();
	            InventoryRefresh();
	            QTYRefresh();
	          }
	        });
	  }

	  function FormRemoveProcess() {
	      $.ajax({
	        url: '{!!URL::to('process/destroy')!!}',
	        type: 'DELETE',
	        data: {'_token': $('input[name=_token]').val()} ,
	        success: function (data) {
	          ReadProcessing();
	          InventoryRefresh();
	          QTYRefresh();
	        }
	      });
	  }

	  function InventoryRefresh() {
	    $.ajax({
	      type:'GET',
	      url:'{!!URL::to('getInventory')!!}',
	      success:function(data){
	       $('#item_id').html(data);
	        }
	      });
	  }

	  function QTYRefresh() {
	    var item_id=$('#item_id').val();
	    $('#stock_id').val('');
	    $('#qty_id').val(0);

	    $.ajax({
	      type:'GET',
	      url:'{!!URL::to('getStock')!!}',
	      data:{'id':item_id},
	      dataType:'json',
	      success:function(data){
	       $('#stock_id').val(data);
	       $('#qty_id').attr('min',0);
	       $('#qty_id').attr('max', data);
	        }
	      });
	  }

	  function ReadProcessing() {
	    $.ajax({
	      type: 'get',
	      url: '{!!URL::to('processList')!!}',
	      dataType: 'html',
	      success: function (data) {
	        $('#ProcessList').html(data);
	      }
	    })
	  }
	</script>
@endsection

