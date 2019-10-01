@extends('layouts.admindek')

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Leasing Agreements';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('lease') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Leasing Agreements</h5>
            <div class="card-header-right">
            <a href="{{ route('lease.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Property">
                <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                    <i class="fa fa-plus fa-sm" style="color: white;"></i>
                </button>
            </a>
            </div>
        </div>
        <div class="card-block">
            @if(count($leases) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                {{-- <th>Agreement ID</th> --}}
                                <th>Property</th>
                                <th>Unit</th>
                                <th>Tenant</th>
                                <th>Rent</th>
                                <th>Move-in Date</th>
                                <th>Reservation Fee</th>
                                <th>Full Payment</th>
                                <th>Utility Deposit</th>
                                <th>Date of Contract</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($leases as $lease)
                            <tr>
                                {{-- <td style="font-size: 13px; font-weight: bold">
                                    <a href="{{ route('lease.show', $lease->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $lease->id }}
                                    </a>
                                </td> --}}
                                <td style="font-size: 13px; font-weight: bold">
                                    <a href="{{ route('property.show', $lease->unit->property->slug) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $lease->unit->property->name }}
                                    </a>
                                </td>
                                <td style="font-size: 13px; font-weight: bold">
                                    <a href="{{ route('unit.show', [$lease->unit->property->slug, $lease->unit->slug]) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $lease->unit->number }}
                                    </a>
                                </td>
                                <td style="font-size: 13px;">
                                    <a href="{{ route('tenant.show', $lease->tenant->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $lease->tenant->user->fullnamewm }}
                                    </a>
                                </td>
                                <td style="font-size: 13px;">{{ $lease->agreed_lease_price_peso }}</td>
                                <td style="font-size: 13px;">{{ date('M d, Y', strtotime($lease->move_in)) }}</td>
                                <td style="font-size: 13px;">{{ $lease->agreed_lease_price_peso }}</td>
                                <td style="font-size: 13px;">{{ $lease->agreed_lease_price_peso }}</td>
                                <td style="font-size: 13px;">{{ $lease->agreed_lease_price_peso }}</td>
                                <td style="font-size: 13px;">{{ date('M d, Y', strtotime($lease->date_of_contract)) }}</td>
                                <td style="font-size: 13px;"><label class="label @if($lease->status == 'Active') label-success @elseif($lease->status == 'Pre-terminated') label-warning @else label-danger @endif">{{ $lease->status }}</label></td>
                                <td style="font-size: 13px;">
                                    <a href="{{ route('lease.show', $lease->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-blue"></i>
                                    </a>
                                    <button type="button" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Edit" id="edit-item" data-item-id="{{ $lease->id}}">
                                        <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                    </button>
                                    <a href="{{ route('lease.destroy', $lease->id) }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Delete">
                                        <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                {{-- <th>Agreement ID</th> --}}
                                <th>Property</th>
                                <th>Unit</th>
                                <th>Tenant</th>
                                <th>Rent</th>
                                <th>Move-in Date</th>
                                <th>Reservation Fee</th>
                                <th>Full Payment</th>
                                <th>Utility Deposit</th>
                                <th>Date of Contract</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                <small>You have no available lease <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>
    </div>
@endsection

@section('modals')
    <script>
        $(document).ready(function() {
          /**
           * for showing edit item popup
           */

          $(document).on('click', "#edit-item", function() {
            $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
              'backdrop': 'static'
            };
            $('#edit-modal').modal(options)
          })

          // on modal show
          $('#edit-modal').on('show.bs.modal', function() {
            var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
            var row = el.closest(".data-row");

            // get the data
            var id = el.data('item-id');
            var name = row.children(".name").text();
            var description = row.children(".description").text();

            // fill the data in the input fields
            $("#modal-input-id").val(id);
            $("#modal-input-name").val(name);
            $("#modal-input-description").val(description);

          })

          // on modal hide
          $('#edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
          })
        })
    </script>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')
@endsection

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modal-label">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
        <form id="edit-form" class="form-horizontal" method="POST" action="">
              <div class="form-group">
                <label class="col-form-label" for="modal-input-id">Id (just for reference not meant to be shown to the general public) </label>
                <input type="text" name="modal-input-id" class="form-control" id="modal-input-id" required>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal-input-name">Name</label>
                <input type="text" name="modal-input-name" class="form-control" id="modal-input-name" required autofocus>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal-input-description">Email</label>
                <input type="text" name="modal-input-description" class="form-control" id="modal-input-description" required>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">Done</button>
        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>