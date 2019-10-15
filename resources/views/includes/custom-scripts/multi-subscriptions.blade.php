<script type="text/javascript">
  $(document).ready(function() {
    $("#itemtable").on('click.a[href="#_js"]', function() {
        return false;
    });

    var qty = $('#qtyid');
    var counter = 1;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><select name="subscriptions[]" class="js-example-basic-single" style="width:100%;"><option disabled selected value>Select Service(s)</option>@foreach ($services->where('is_subscription', true) as $subscription)<option value="{{ $subscription->id }}">{{ $subscription->name }} ({{ $subscription->monthly_price_length }})</option>@endforeach</select></td>';
        cols += '<td><div class="input-group"><span class="input-group-prepend"><label class="input-group-text">{{ config('pms.currency.sign') }}</label></span><input type="number" min="1" step="any" name="amounts[]" class="form-control {{-- autonumber fill --}}" data-a-sign="{{ config('pms.currency.sign') }}"></div></td>';

        cols += '<td><a href="#" id="btnDel"><button class="btn waves-effect waves-light btn-danger btn-icon" style="height: 40px;width: 40px; padding: 0;line-height: 0;padding-left: 6px;"><i class="fa fa-minus"></i></button></a></td>';

        newRow.append(cols);
        console.log(cols)
        $("#itemtable").append(newRow);
        counter++;

        $('#qtyid').val(counter);
        console.log(counter);
        reload();
    });

    $("#itemtable").on("click", "#btnDel", function (event) {
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