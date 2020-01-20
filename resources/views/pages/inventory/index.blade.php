@extends('layouts.admindek', ['pageSlug' => 'inventory-index'])

@section('css-plugin')
    @include('includes.plugins.datatable-css')
@endsection

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.inventory.icon');
        $breadcrumb_title = config('pms.breadcrumbs.inventory.inventory-index.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.inventory.inventory-index.subtitle');
    @endphp
    {{ Breadcrumbs::render('inventory') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h5>Inventory Items</h5>
            </div>
            <div class="card-header-right">
                @can('Create Inventory')
                    <a href="{{ route('inventory.create') }}" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="Add Item">
                        <button class="btn waves-effect waves-light btn-success btn-icon" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 2px;">
                            <i class="fa fa-plus fa-sm" style="color: white;"></i>
                        </button>
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-block">
            @if(count($inventories) > 0)
                <div>
                    <table id="order-table" class="table table-bordered table-responsive wrap">
                        <thead>
                            <tr>
                                <th class="{{ config('pms.table.th.font-size') }}">Code</th>
                                <th class="{{ config('pms.table.th.font-size') }}" width="60%">Description</th>
                                <th class="{{ config('pms.table.th.font-size') }}">QTY</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Price</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Date Created</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Last Updated</th>
                                <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventories as $inventory)
                                <tr>
                                    <td class="{{ config('pms.table.td.font-size') }} f-w-700">
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                            {{ $inventory->code }}
                                        </a>
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      {{ $inventory->description }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      {{ $inventory->qty }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                      {{ currencysign($inventory->price) }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $inventory->created_at }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        {{ $inventory->updated_at }}
                                    </td>
                                    <td class="{{ config('pms.table.td.font-size') }}">
                                        <a href="" id="btn-modal-restock" data-toggle="modal" data-target="#modal-restock"
                                            data-id="{{ $inventory->id }}"
                                            data-qty="{{ $inventory->qty }}"
                                        >
                                            <i class="{{ config('pms.action.add-stock.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.add-stock.color') }}"></i>
                                        </a>
                                        <a href="" id="btn-modal-reduce" data-toggle="modal" data-target="#modal-reduce"
                                            data-id="{{ $inventory->id }}"
                                            data-qty="{{ $inventory->qty }}"
                                        >
                                            <i class="{{ config('pms.action.reduce-stock.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.reduce-stock.color') }}"></i>
                                        </a>

                                        <a href="" id="btn-modal-edit" data-toggle="modal" data-target="#modal-edit"
                                            data-id="{{ $inventory->id }}"
                                            data-description="{{ $inventory->description }}"
                                            data-price="{{ $inventory->price }}"
                                        >
                                            <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                        </a>

                                        <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
                                            <i class="{{ config('pms.action.delete.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.delete.color') }}"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                <small>You have no available inventory items <a href="#" title="" style="color:#4099ff;font-size: 12px;">Add here.</a></small>
            @endif
        </div>

    </div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update-inventory" method="POST" action="">
            @CSRF @METHOD('PATCH')
                <div class="modal-body">
                    <input type="text" name="field_id" id="field_id" value="" hidden>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Description</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" class="form-control" name="field_description" id="field_description" value="" form="update-inventory">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Price</label>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text">{{ config('pms.currency.sign') }}</label>
                                    </span>
                                    <input type="number" min="1" step="any" class="form-control {{-- autonumber fill --}}" name="field_price" id="field_price" value="" form="update-inventory">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" form="update-inventory">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-restock" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Restock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update-inventory-restock" method="POST" action="">
            @CSRF @METHOD('PATCH')
                <div class="modal-body">
                    <input type="text" name="field_id" id="field_id" value="" hidden>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Quantity</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="number" min="1" step="any" class="form-control {{-- autonumber fill --}}" name="field_qty" id="field_qty" value="" form="update-inventory-restock" required="">
                            </div>
                    </div>
                    <div class="form-group row">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" form="update-inventory-restock">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-reduce" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reduce</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update-inventory-reduce" method="POST" action="">
            @CSRF @METHOD('PATCH')
                <div class="modal-body">
                    <input type="text" name="field_id" id="field_id" value="" hidden>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Quantity</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="number" min="1" step="any" class="form-control {{-- autonumber fill --}}" name="field_qty" id="field_qty" value="" form="update-inventory-reduce" required="">
                            </div>
                    </div>
                    <div class="form-group row">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" form="update-inventory-reduce">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js-plugin')
    @include('includes.plugins.datatable-js')

    <script type="text/javascript">
        
        $(document).ready(function(){
            $(document).on('click', '#btn-modal-edit', function() {
                var selected_id = $(this).data('id');
                $('#field_id').val($(this).data('id'));
                $('#field_description').val($(this).data('description'));
                $('#field_price').val($(this).data('price'));

                $("#update-inventory").attr("action", "{!!URL::to('inventory/"+selected_id+"')!!}");

                $('#modal-edit').modal('show');
            });

            $(document).on('click', '#btn-modal-restock', function() {
                var selected_id = $(this).data('id');
                $('#field_id').val($(this).data('id'));

                $("#update-inventory-restock").attr("action", "{!!URL::to('restock/"+selected_id+"')!!}");

                $('#modal-restock').modal('show');
            });

            $(document).on('click', '#btn-modal-reduce', function() {
                var selected_id = $(this).data('id');
                $('#field_id').val($(this).data('id'));

                $("#update-inventory-reduce").attr("action", "{!!URL::to('reduce/"+selected_id+"')!!}");

                $('#modal-reduce').modal('show');
            });

        });

    </script>

@endsection
