{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
<script type="text/javascript">

    function btnPublish() {
        event.preventDefault();
        var form = event.target.form;
        var x = document.getElementsByName('publish-bill');
            swal({
                title: 'Are you sure?',
                text: 'If an existing billing invoice has been published, any changes will override the existing published bill.',
                icon: 'warning',
                buttons: {
                    delete: {
                        text: "Confirm",
                    value: "return",
                    },
                    cancel: "Cancel"
                },
                })
                .then((value) => {
                  switch (value) {
                 
                    case "return":
                        x[0].submit();
                        // form.submit();
                          swal("Publishing..", "Bill is currently publishing, redirecting...", "info");
                          break;
                 
                    default:
                      swal("Publishing cancelled");
                  }
                });
        // }
    }
</script>