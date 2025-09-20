<!-- BEGIN VENDOR JS-->
<script src="{{asset('asset/dashboard')}}/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('asset/dashboard')}}/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/charts/chartist-plugin-tooltip.min.js"
type="text/javascript"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/charts/morris.min.js" type="text/javascript"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/timeline/horizontal-timeline.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('asset/dashboard')}}/js/core/app-menu.js" type="text/javascript"></script>
<script src="{{asset('asset/dashboard')}}/js/core/app.js" type="text/javascript"></script>
<script src="{{asset('asset/dashboard')}}/js/scripts/customizer.js" type="text/javascript"></script>
<!-- END MODERN JS-->
<script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>

<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('asset/dashboard')}}/js/scripts/pages/dashboard-ecommerce.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->


 {{-- sweet alerts --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
    // translations
    let title = "{{ __('dashboard.are_you_sure') }}";
    let text = "{{ __('dashboard.delete_warning_text') }}";
    let confirmText = "{{ __('dashboard.confirm_delete') }}";
    let cancelText = "{{ __('dashboard.cancel_delete') }}";
    let deletedTitle = "{{ __('dashboard.deleted_title') }}";
    let deletedText = "{{ __('dashboard.deleted_success') }}";
    let cancelledTitle = "{{ __('dashboard.cancelled_title') }}";
    let cancelledText = "{{ __('dashboard.cancelled_text') }}";

    $(document).on('click', '.delete_confirm', function(e) {
        e.preventDefault();
        form = $(this).closest('form');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: true
        });
        swalWithBootstrapButtons.fire({
            title: title,
            text: text,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                swalWithBootstrapButtons.fire({
                    title: deletedTitle,
                    text: deletedText,
                    icon: "success"
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: cancelledTitle,
                    text: cancelledText,
                    icon: "error"
                });
            }
        });
    });
</script>

 {{-- End sweet alerts --}}
{{-- Core DataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

{{-- Col and Row Reorder --}}
<script src="https://cdn.datatables.net/colreorder/2.0.4/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.min.js"></script>

{{-- Select --}}
<link rel="stylesheet" href="https://cdn.datatables.net/select/2.1.0/css/select.dataTables.min.css">
<script src="https://cdn.datatables.net/select/2.1.0/js/dataTables.select.min.js"></script>

{{-- Responsive --}}
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>

{{-- Buttons --}}
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>

{{-- Excel + PDF dependencies --}}
<script src="{{ asset('vendor/datatables/excel/jszip.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/pdf/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/pdf/vfs_fonts.js') }}"></script>

{{-- Fixed Header --}}
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.bootstrap5.min.js"></script>

{{-- Scroller --}}
<script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.min.js"></script>


 {{-- fileinput --}}
<script src="{{ asset('vendor/file-input/js/fileinput.min.js') }}"></script>
<script src="{{ asset('vendor/file-input/themes/fa5/theme.min.js') }}"></script>

@if(Config::get('app.locale') == 'ar')
<script src="{{ asset('vendor/file-input/js/locales/LANG.js')}}"></script>
<script src="{{ asset('vendor/file-input/js/locales/ar.js') }}"></script>
@endif
<script>
    var lang = "{{ app()->getLocale() }}";
    $(function() {
         $('#single-image').fileinput({
             theme: 'fa5',
             language:lang,
             allowedFileTypes: ['image'],
             maxFileCount: 1,
             enableResumableUpload: false,
             showUpload: false,

         });

     });
</script>
{{-- end fileinput --}}

@stack('js')

