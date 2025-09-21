<!-- Modal -->
<div class="modal fade" id="editCouponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.create_coupon') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- validations error --}}
                <div class="alert alert-danger" id="error_div_edit" style="display: none;">
                    <ul id="error_list_edit"></ul>
                </div>


               <form action="" id="updateCoupon" class="form" method="POST">
    @csrf
    @method('PUT')

    <input id="coupon_id" hidden name="id" value="">

    {{-- code_coupon --}}
    <div class="form-group">
        <label for="coupon_code_coupon">{{ __('dashboard.code_coupon') }}</label>
        <input id="coupon_code_coupon" type="text" name="code_coupon" class="form-control"
            placeholder="{{ __('dashboard.code_coupon') }}">
        <strong class="text-danger" id="error_code_coupon"></strong>
    </div>

    {{-- discount type --}}
    <div class="form-group">
        <label for="coupon_discount_type">{{ __('dashboard.discount_type') }}</label>
        <select name="discount_type" id="coupon_discount_type" class="form-control">
            <option value="percentage">{{ __('dashboard.percentage') }}</option>
            <option value="fixed">{{ __('dashboard.fixed') }}</option>
        </select>
        <strong class="text-danger" id="error_discount_type"></strong>
    </div>

    {{-- discount value --}}
    <div class="form-group">
        <label for="coupon_discount_value">{{ __('dashboard.discount_value') }}</label>
        <input type="number" step="0.01" name="discount_value" class="form-control"
            id="coupon_discount_value" placeholder="{{ __('dashboard.discount_value') }}">
        <strong class="text-danger" id="error_discount_value"></strong>
    </div>

    {{-- min cart value --}}
    <div class="form-group">
        <label for="coupon_min_cart_value">{{ __('dashboard.min_cart_value') }}</label>
        <input type="number" step="0.01" name="min_cart_value" class="form-control"
            id="coupon_min_cart_value" placeholder="{{ __('dashboard.min_cart_value') }}">
        <strong class="text-danger" id="error_min_cart_value"></strong>
    </div>

    {{-- limit --}}
    <div class="form-group">
        <label for="coupon_limit">{{ __('dashboard.limitation') }}</label>
        <input id="coupon_limit" type="number" name="limit" class="form-control"
            placeholder="{{ __('dashboard.limitation') }}">
        <strong class="text-danger" id="error_limit"></strong>
    </div>

    {{-- start date --}}
    <div class="form-group">
        <label for="coupon_start_date">{{ __('dashboard.start_date') }}</label>
        <input id="coupon_start_date" type="date" name="start_date" class="form-control"
            placeholder="{{ __('dashboard.start_date') }}">
        <strong class="text-danger" id="error_start_date"></strong>
    </div>

    {{-- end date --}}
    <div class="form-group">
        <label for="coupon_end_date">{{ __('dashboard.end_date') }}</label>
        <input id="coupon_end_date" type="date" name="end_date" class="form-control"
            placeholder="{{ __('dashboard.end_date') }}">
        <strong class="text-danger" id="error_end_date"></strong>
    </div>

    {{-- is active --}}
    <div class="form-group">
        <label>{{ __('dashboard.is_active') }}</label>
        <div class="input-group">
            <div class="d-inline-block custom-control custom-radio mr-1">
                <input type="radio" value="1" name="is_active" class="custom-control-input"
                    id="active_coupon">
                <label class="custom-control-label" for="active_coupon">{{ __('dashboard.active') }}</label>
            </div>
            <div class="d-inline-block custom-control custom-radio">
                <input type="radio" value="0" name="is_active" class="custom-control-input"
                    id="inactive_coupon">
                <label class="custom-control-label" for="inactive_coupon">{{ __('dashboard.inactive') }}</label>
            </div>
        </div>
        <strong class="text-danger" id="error_is_active"></strong>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="ft-x"></i>{{ __('dashboard.close') }}
        </button>
        <button type="submit" class="btn btn-primary" onclick="clearErrors()">
            <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}
        </button>
    </div>
</form>

            </div>

        </div>
    </div>
</div>
