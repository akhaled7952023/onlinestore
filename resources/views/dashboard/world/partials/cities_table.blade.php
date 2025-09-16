<table class="table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('dashboard.Governorat') }}</th>
                                            <th scope="col">{{ __('dashboard.city_name') }} </th>
                                            <th scope="col">{{ __('dashboard.num_of_users') }} </th>
                                            <th scope="col">{{ __('dashboard.status') }} </th>
                                            <th scope="col">{{ __('dashboard.status_management') }} </th>
                                            <th scope="col">{{ __('dashboard.shipping_price') }} </th>
                                            <th scope="col">{{ __('dashboard.change_price') }} </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($cities as $city)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $city->governorate->name }}

                                                </td>
                                                <td>{{ $city->name }}
                                                </td>


                                                <td>
                                                    <div class="badge badge-pill badge-border border-primary success lg">
                                                        {{ $city->users->count() }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <div id="status_{{ $city->id }}"
                                                        class="badge badge-pill badge-border border-info success lg">
                                                        {{ $city->is_active }}</div>
                                                </td>

                                                <td>
                                                    <input type="checkbox" class="switch change_status"
                                                        city-id={{ $city->id }} id="switch5"
                                                        @if ($city->is_active == 'Active' || $city->is_active == 'مفعل') checked @endif
                                                        data-group-cls="btn-group-sm" />
                                                </td>

                                                <td>
                                                    <div id="price_{{ $city->id }}" class="">
                                                        {{ $city->shippingPrice->price }} </div>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#change_price_{{ $city->id }}">
                                                        {{ __('dashboard.change_price') }}
                                                    </button>
                                                </td>


                                            </tr>


                                            {{--  change shipping price modal  --}}
                                            @include('dashboard.world.charge')

                                        @empty
                                            <td colspan="4"> No Data</td>
                                        @endforelse
                                    </tbody>
                                </table>
                                @if(method_exists($cities, 'links'))
    {{ $cities->links() }}
@endif

