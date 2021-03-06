@extends('layouts.master')

@section('styles')
    <link href="{{asset('/default/assets/bootstrap-fileinput/bootstrap-fileinput.css')}}"
          rel="stylesheet"
          type="text/css"/>

@endsection
@section('pageHeader')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Add News
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
                        <a href="{{route('listNews')}}" class="m-nav__link">
											<span class="m-nav__link-text">
                                                news
											</span>

                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{route('newsForm')}}" class="m-nav__link">
											<span class="m-nav__link-text">
												Add News
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
                        News Controller
                    </h3>
                </div>
            </div>
        </div>
        <!--begin::Form-->
        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post"
              enctype="multipart/form-data"
              action="{{route('addNews')}}">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label class="">
                            title:
                        </label>
                        <input name="title" value="{{old('title')}}" class="form-control m-input">

                        <span class="m-form__help">
														Please enter your news title
													</span>
                    </div>
                    <div class="col-lg-6">
                        <label class="">
                            Description:
                        </label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                                    <textarea name="description" class="form-control" data-provide="markdown"
                                              rows="10">{{old('description')}}</textarea>
                        </div>

                    </div>

                </div>
                @if(Auth::user()->hasRole('admin'))
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <div class="form-group col-md-4">
                                <label>Show on main page</label>
                                <div class="input-group">
                                    <div class="mt-radio-list">
                                        <label class="mt-radio mt-radio-outline">
                                            <input type="radio" name="approval" id="yes"
                                                   value="1"> yes
                                            <span></span>
                                        </label>
                                        <label class="mt-radio mt-radio-outline">
                                            <input type="radio" name="approval" id="no"
                                                   value="0" checked> no
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                @endif
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary">
                                add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/default/assets/bootstrap-fileinput/bootstrap-fileinput.js')}}"
            type="text/javascript"></script>
@endsection