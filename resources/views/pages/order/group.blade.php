        <div class="card">
            <div class="card-header">
                <h5>Job Orders</h5>
            </div>
            <div class="card-block">
                @if(count($orders) > 0)
                    <div>
                        <table id="order-table" class="table table-bordered table-responsive wrap">
                            <thead>
                                <tr>
                                    <th class="{{ config('pms.table.th.font-size') }}">NO</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Type</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Description</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">To Bill</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Total Amount</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Date Created</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Last Updated</th>
                                    <th class="{{ config('pms.table.th.font-size') }}">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="{{ config('pms.table.td.font-size') }} f-w-600">
                                            <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="View Details">
                                                    {{ $order->order_no }}
                                                </a>
                                        </td>
                                        <td class="{{ config('pms.table.td.font-size') }}">
                                            {{ $order->type->name }}
                                        </td>
                                        <td class="{{ config('pms.table.td.font-size') }}">
                                            {{ $order->description }}
                                        </td>
                                        <td class="{{ config('pms.table.td.font-size') }}">
                                            {{ $order->to_bill }}
                                        </td>
                                        <td class="{{ config('pms.table.td.font-size') }}">
                                            {{ $order->total_amount }}
                                        </td>
                                        <td class="{{ config('pms.table.td.font-size') }}">{{ $order->created_at }}</td>
                                        <td class="{{ config('pms.table.td.font-size') }}">{{ $order->updated_at }}</td>
                                        <td class="{{ config('pms.table.td.font-size') }}">
                                            @can('Update Orders')
                                                <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.edit.tool-tip-text') }}">
                                                    <i class="{{ config('pms.action.edit.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.edit.color') }}"></i>
                                                </a>
                                            @endcan
                                             @can('Delete Orders')
                                                <a href="#" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{ config('pms.action.delete.tool-tip-text') }}">
                                                    <i class="{{ config('pms.action.delete.icon') }} {{ config('pms.action.weight') }} {{config('pms.action.size') }} {{ config('pms.action.margin') }} {{ config('pms.action.delete.color') }}"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <button class="btn waves-effect waves-light btn-warning btn-icon" type="button" style="height: 30px;width: 30px; padding: 0;line-height: 0;padding-left: 4px;"><i class="fa fa-warning"></i></button>
                    <small>No job orders found.</small>
                @endif
            </div>
        </div>