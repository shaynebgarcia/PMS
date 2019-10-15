<script type="text/javascript">
  $(document).ready(function() {
    $("#waterbilltable").on('click.a[href="#_js"]', function() {
        return false;
    });

    var qty = $('#qtyid');
    var counter = 1;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><select name="water_meters[]" class="js-example-basic-single" style="width:100%;"><option disabled selected value>Select Unit/Meter</option>@foreach ($utilities->where('utility_type_id', 2) as $water_meter)<option value="{{ $water_meter->id }}">{{ $water_meter->no }} | {{ $water_meter->unit->number }} ({{ $water_meter->unit->status }})</option>@endforeach</select></td>';
        cols += '<td><div class="input-group"><span class="input-group-prepend"><label class="input-group-text">{{ config('pms.currency.sign') }}</label></span><input type="number" min="1" step="any" name="amounts[]" class="form-control {{-- autonumber fill --}}" data-a-sign="{{ config('pms.currency.sign') }}"></div></td>';

        cols += '<td><a href="#" id="btnDel"><button class="btn waves-effect waves-light btn-danger btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;"><i class="fa fa-minus"></i></button></a></td>';

        newRow.append(cols);
        console.log(cols)
        $("#waterbilltable").append(newRow);
        counter++;

        $('#qtyid').val(counter);
        console.log(counter);
        reload();
    });

    $("#waterbilltable").on("click", "#btnDel", function (event) {
        if( $(this).closest("tr").is("tr:only-child") ) {
            swal({
            title: 'Take note!',
            text: 'Deleting the last row will result to "No other service selected"',
            icon: 'info',
            });
          $(this).closest("tr").remove();
            counter -= 1
          $('#qtyid').val(counter);
        }
        else {
            $(this).closest("tr").remove();
            counter -= 1
            $('#qtyid').val(counter);
        }
    });

  });

  function calculateRow(row) {
    var qty = +row.find('input[name^="qtys[]"]').val();
    $("#qtyid").text(qty);
  }
  function reload() {
        $('.js-example-basic-single').select2();
    }

</script>