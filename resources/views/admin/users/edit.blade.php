@extends('layouts.master')
@section('pageHeader')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Edit Users
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{route('home')}}" class="m-nav__link">
											<span class="m-nav__link-text">
												Home
											</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{route('listUsers')}}" class="m-nav__link">
											<span class="m-nav__link-text">
                                                Users
											</span>

                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{route('editUsersForm',['user'=>$user->id])}}" class="m-nav__link">
											<span class="m-nav__link-text">
												Edit Users
											</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
@section('content')
    @include('includes.info-box')
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                    <h3 class="m-portlet__head-text">
                        User Controller
                    </h3>
                </div>
            </div>
        </div>
        <!--begin::Form-->
        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post"
              action="{{route('updateUsers',['user'=>$user->id])}}">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label>
                            Full Name:
                        </label>
                        <input type="text" name="name" value="{{old('name')?old('name'):$user->name}}"
                               class="form-control m-input" placeholder="Enter full name">
                        <span class="m-form__help">
														Please enter your full name
													</span>
                    </div>
                    <div class="col-lg-6">
                        <label class="">
                            Email:
                        </label>
                        <input type="text" name="email" value="{{old('email')?old('email'):$user->email}}"
                               class="form-control m-input" placeholder="Enter email address">
                        <span class="m-form__help">
														Please enter your contact number
													</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label>
                            Password:
                        </label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="password" name="password" class="form-control m-input"
                                   placeholder="Enter your password">
                        </div>
                        <span class="m-form__help">
														Please enter your address
													</span>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary">
                                submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>


@endsection
