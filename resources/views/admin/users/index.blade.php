@extends('layouts.master')
@section('pageHeader')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Users
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
                    <li class="m-nav__item">
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('content')
    @include('includes.info-box')
    <div class="alert alert-danger d-none">
        <span class="err-content"></span>
    </div>
    <div class="alert alert-success d-none">
        <span>User Deleted Successfully.</span>
    </div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Users Table
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-4">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input m-input--solid"
                                           placeholder="Search..." id="generalSearch">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
															<span>
																<i class="la la-search"></i>
															</span>
														</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        <a href="{{route('usersForm')}}"
                           class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
												<span>
													<i class="la la-plus"></i>
													<span>
														Add User
													</span>
												</span>
                        </a>
                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <table class="m-datatable" id="html_table" width="100%">
                <thead>
                <tr>
                    <th title="Field #1">
                        Name
                    </th>
                    <th title="Field #2">
                        Email
                    </th>
                    <th title="Field #3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr id="item-{{ $user->id }}">
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            <a href="{{route('editUsersForm',[$user->id])}}"
                               class="btn btn-outline-brand active">
                                Edit
                            </a>
                            <button type="button" class="btn btn-outline-danger active delete-modal" data-toggle="modal"
                                    data-id="{{ $user->id }}" data-target="#m_modal_4">
                                Delete
                            </button>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
    <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												&times;
											</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="generalComponent">
                        Are you sure you want Delete ?
                        <input class="generalComponent" type="hidden" id="id" name="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary delete-user btn-danger" id="footer_action_button">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('default/assets/demo/default/custom/components/datatables/base/html-table.js')}}
            "
            type="text/javascript"></script>
    <script>
        $(document).on('click', '.delete-modal', function () {
            $('#id').val($(this).attr('data-id'));
        });

        $('.modal-footer').on('click', '.delete-user', function () {

            var id = $('input[name=id]').val();

            $.ajax({
                type: 'post',
                url: 'users/' + id + '/delete',
                success: function (data) {
                    window.location.reload();
                    $('#item-' + id).remove();
                    $('.alert-danger').addClass('d-none');
                    $('.alert-success').removeClass('d-none');
                    setTimeout(function () {
                        $('.alert-success').addClass('d-none');
                    }, 3000);
                }
            });
        });
    </script>

@endsection