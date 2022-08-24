@extends('layouts.app')

@section('content')

    @php( $title =  __( 'Оформить заказ' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'constructor-edit' => [
                'title'     => $title,
                'url'       => '',
                'active'    => true
            ]
        ]
    ])

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12 grid-margin ">

            <!-- Title -->
            <h4 class="card-title">
                {{ $title }}
            </h4>
            <!-- End Title -->

            @include('template-parts.message')
            <!-- Row -->
            <div class="row">

                <!-- Col -->
                <div class="col-lg-8 grid-margin stretch-card">

                    <!-- card -->
                    <div class="card">
                        <!-- card-body -->
                        <div class="card-body">

                            <!-- Title -->
                            <h6 class="card-title">
                                {{ __( 'Найти Клиента' ) }}
                            </h6>
                            <!-- End Title -->

                            <!-- row -->
                            <div class="row">

                                <!-- Col -->
                                <div class="col-lg-6">
                                    
                                    <!-- Form -->
                                    <form action="{{ url()->current() }}" method="GET">
                                    
                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( 'Номер Телефона' ) }}
                                            </label>
                                            {!! html_input('text', 'phone', old('phone'), ['class' => 'form-control', 'id' => 'phone', 'value' => request('phone')]) !!}
                                        </div>
                                        <!-- end form group -->
                                    
                                        
                                        
                                        <!-- fieldset -->
                                        <fieldset>
                                            
                                            <button type="submit" class="btn btn-primary">
                                                {{ __( 'Найти' ) }}
                                            </button>
                                            
                                        </fieldset>
                                        <!-- end fieldset -->
                                    </form>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- end row -->



                            <!-- Product gred --->
                            <form action="{{route('users.orders.store')}}" method="post" id="order-products-form">
                                @csrf
                                <div id="products" class="mt-4">
                                    
                                    <div class="row mx-0 products_row">
                                    
                                        <!-- Appending Products by js  -->
                                
                                    </div>
                                
                                </div>
                                <!-- fieldset -->
                                <fieldset  id="product-form-fieldset" class="d-none">
                                    
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Расчёт')}}
                                    </button>
                                    
                                </fieldset>
                                <!-- end fieldset -->
                            </form>
                            <!-- End product gred --->

                        </div>
                        <!-- end card-body -->

                    </div>
                    <!-- end card -->

                </div>
                <!-- End Col -->

                <!-- Col -->
                <div class="col-lg-4 grid-margin stretch-card">

                    <!-- card -->
                    <div class="card">

                        <!-- card-body -->
                        <div class="card-body">

                            <!-- founded-user -->
                            @if($user)

                                <!-- Title -->
                                <h4 class="card-title">
                                    {{ __( 'Пользователь' ) }}
                                </h4>
                                <!-- End Title -->

                                <div class="col-lg-12">

                                    @php ($detail = $user->detail)

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item list-group-item-success">
                                            {{ __( 'Имя' ) }} : {{ $detail->first_name }}
                                        </li>
                                        <li class="list-group-item list-group-item-success">
                                            {{ __( 'Фамилия' ) }} : {{ $detail->last_name }}
                                        </li>
                                        <li class="list-group-item list-group-item-success">
                                            {{ __( 'Номер телефона' ) }} : {{ $detail->phone }}
                                        </li>
                                        <li class="list-group-item list-group-item-success">
                                            {{ __( 'Ел. адрес' ) }} : {{ $user->email }}
                                        </li>
                                        </ul>
                                </div>
                            @endif
                            <!-- founded-user-end -->

                            <!-- Title -->
                            <h4 class="card-title mt-4">
                                {{ __( 'Продукты' ) }}
                            </h4>
                            <!-- End Title -->

                            <div class="col-lg-12">
                                
                                <!-- Product list -->
                                <ul class="list-group list-group-flush">
                                    
                                    @foreach($items as $item)
                                    
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            
                                            {{ $loop->iteration }}. {{ $item->name }}
                                            
                                            <span class="badge badge-primary badge-pill item" data-id="{{$item->id}}">
                                                <i class="link-arrow" data-feather="shopping-cart"></i>
                                            </span>
                                        
                                        </li>

                                    @endforeach
                                    
                                </ul>
                                <!-- Product list end-->
                            
                            </div>

                        </div>
                        <!-- end card-body -->

                    </div>
                    <!-- end card -->

                </div>
                <!-- End Col -->

            </div>
            <!-- End Row -->
        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
