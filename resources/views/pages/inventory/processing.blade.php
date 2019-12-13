@if (count($processing) > 0)
  <table class="table table-bordered" name="processing_table">
    <thead>
      <tr>
        <th class="f-12" width="5%">NO</th>
        <th class="f-12" width="15%">Code</th>
        <th class="f-12" width="60%">Description</th>
        <th class="f-12" width="10%">QTY</th>
        <th class="f-12" width="10%">Status</th>
        </th>
    </thead>
    <tbody>
      <?php $i=1 ?>
        @foreach ($processing as $p)
        <tr>
          <td class="f-12 text-left">{{$i++}}</td>
          <th class="f-12">{{ $p->item->code }}</th>
          <td class="f-12">{{ $p->item->description }}</td>
          <td class="f-12">{{ $p->qty }}</td>
          <td class="f-12">Processing</td>
        </tr>
        @endforeach
    </tbody>
  </table>
@else
  <p class="f-s-italic text-center">No processing item found</p>
@endif