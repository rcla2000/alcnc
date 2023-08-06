@routes
<script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/mdb.min.js')}}"></script>
<!-- Plugin file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.6/b-2.4.1/b-colvis-2.4.1/b-html5-2.4.1/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
<!-- MDBootstrap Cards Extended Pro  -->
<script src="{{ asset('js/dashboard.js')}}"></script>
<script type="text/javascript">
    // Material Select Initialization
    $(document).ready(function() {
        $('.mdb-select').materialSelect();
    });
</script>
@yield('scripts')