<!-- Modal -->
<div class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div class="alert alert-danger" id="error_div" style="display: none;">
                    <ul id="error_list"></ul>
                </div>

                <form action="" id="createCoupon" class="form" method="POST">
                    @csrf

                    {{-- code --}}
                    <div class="form-group">
                        <label for="code_coupon">{{ __('dashboard.code_coupon') }}</label>
                        <input type="text" name="code_coupon" class="form-control" id="code_coupon"
                            placeholder="{{ __('dashboard.code_coupon') }}">
                        <strong class="text-danger" id="error_code"></strong>
                    </div>

                    {{-- discount type --}}
                    <div class="form-group">
                        <label for="discount_type">{{ __('dashboard.discount_type') }}</label>
                        <select name="discount_type" id="discount_type" class="form-control">
                            <option value="percentage">{{ __('dashboard.percentage') }}</option>
                            <option value="fixed">{{ __('dashboard.fixed') }}</option>
                        </select>
                        <strong class="text-danger" id="error_discount_type"></strong>
                    </div>

                    {{-- discount value --}}
                    <div class="form-group">
                        <label for="discount_value">{{ __('dashboard.discount_value') }}</label>
                        <input type="number" step="0.01" name="discount_value" class="form-control"
                            id="discount_value" placeholder="{{ __('dashboard.discount_value') }}">
                        <strong class="text-danger" id="error_discount_value"></strong>
                    </div>

                    {{-- min cart value --}}
                    <div class="form-group">
                        <label for="min_cart_value">{{ __('dashboard.min_cart_value') }}</label>
                        <input type="number" step="0.01" name="min_cart_value" class="form-control"
                            id="min_cart_value" placeholder="{{ __('dashboard.min_cart_value') }}">
                        <strong class="text-danger" id="error_min_cart_value"></strong>
                    </div>

                    {{-- limit --}}
                    <div class="form-group">
                        <label for="limit">{{ __('dashboard.limitation') }}</label>
                        <input type="number" name="limit" class="form-control" id="limit"
                            placeholder="{{ __('dashboard.limitation') }}">
                        <strong class="text-danger" id="error_limit"></strong>
                    </div>

                    {{-- start date --}}
                    <div class="form-group">
                        <label for="start_date">{{ __('dashboard.start_date') }}</label>
                        <input type="date" name="start_date" class="form-control" id="start_date"
                            placeholder="{{ __('dashboard.start_date') }}">
                        <strong class="text-danger" id="error_start_date"></strong>
                    </div>

                    {{-- end date --}}
                    <div class="form-group">
                        <label for="end_date">{{ __('dashboard.end_date') }}</label>
                        <input type="date" name="end_date" class="form-control" id="end_date"
                            placeholder="{{ __('dashboard.end_date') }}">
                        <strong class="text-danger" id="error_end_date"></strong>
                    </div>

                    {{-- is active --}}
                    <div class="form-group">
                        <label>{{ __('dashboard.is_active') }}</label>
                        <div class="input-group">
                            <div class="d-inline-block custom-control custom-radio mr-1">
                                <input type="radio" value="1" name="is_active" class="custom-control-input"
                                    id="yes1">
                                <label class="custom-control-label"
                                    for="yes1">{{ __('dashboard.active') }}</label>
                            </div>
                            <div class="d-inline-block custom-control custom-radio">
                                <input type="radio" value="0" name="is_active" class="custom-control-input"
                                    id="no1">
                                <label class="custom-control-label"
                                    for="no1">{{ __('dashboard.inactive') }}</label>
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
