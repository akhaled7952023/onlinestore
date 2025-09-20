@extends('layouts.dashboard.app')
@section('title')
    shipping
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.countries.index') }}">
                                        {{ __('dashboard.countries') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">{{ __('dashboard.cities') }} &
                                        {{ __('dashboard.shipping') }}</a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.cities') }}
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            {{-- alert --}}
                            @include('dashboard.includes.tostar-success')
                            @include('dashboard.includes.tostar-error')

                            <form action="{{ url()->current() }}" method="GET">

                                <div class="row">
                                    <div class="col-md-3">
                                        <input id="city-search" name="keyword" type="text" class="form-control"
                                            placeholder="{{ __('dashboard.search') }}">
                                    </div>
                                </div>
                                <br>
                            </form>

                            <div id="table_live">
                                <div id="cities-table-wrapper">
    @include('dashboard.world.partials.cities_table', ['cities' => $cities])

</div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('asset/dashboard') }}/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="{{ asset('asset/dashboard') }}/vendors/js/forms/toggle/bootstrap-checkbox.min.js" type="text/javascript">
    </script>

    <script src="{{ asset('asset/dashboard') }}/js/scripts/tables/components/table-components.js" type="text/javascript">
    </script>


       {{-- // live search --}}


    {{-- change status --}}
    <script>
        $(document).on('change', '.change_status', function() {

            var id = $(this).attr('city-id');
            var url = "{{ route('dashboard.cities.status', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'GET',

                success: function(response) {
                    if (response.status == 'success') {

                        $('.tostar_success').text(response.message).show();

                        // change status
                        $('#status_' + response.data.id).empty();
                        $('#status_' + response.data.id).text(response.data.is_active);

                    } else {
                        $('.tostar_error').show();
                        $('.tostar_error').text(data.message);
                    }

                    setTimeout(function() {
                        $('.tostar_success').hide();
                    }, 5000);

                }

            });
        });
    </script>

    {{-- update shipping price --}}
    <script>
        $(document).on('submit', '.update_shipping_price', function(e) {
            e.preventDefault();

            var data = new FormData($(this)[0]);
            var city_id = $(this).attr('city-id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('dashboard.cities.shipping-price') }}",
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 'success') {

                        // $('.tostar_success').text(response.message).show();

                        // change price
                        $('#price_' + response.data.id).empty();
                        $('#price_' + response.data.id).text(response.data.shipping_price.price);


                    }

                },

                error: function(data) {
                    var response = $.parseJSON(data.responseText);
                    $('#errors_' + city_id).text(response.errors.price).show();
                },


            });
        });
    </script>


        <script>
   $(document).on('keyup', '#city-search', function() {
    let keyword = $(this).val();

    $.ajax({
        url: "{{ route('dashboard.cities.search') }}",
        type: 'GET',
        data: { keyword: keyword },
        success: function(response) {
            $('#cities-table-wrapper').html(response);
            $('input.switch').checkboxpicker();

        }
    });
});

</script>

@endpush
