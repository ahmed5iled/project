@extends('layouts.master')
@section('content')
    @if(Auth::check())
        @include('includes.info-box')
        <div class="alert alert-danger  d-none">
            <span class="err-content"></span>
        </div>
        <div class="alert alert-success d-none">
            <span>Thanks for your comment ,please wait for approval .</span>
        </div>

        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="form-group m-form__group row align-items-center">
                        <div class="col-md-4">
                            <div class="m-input-icon m-input-icon--left">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                    <a href="{{route('addNewsForm')}}"
                       class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
												<span>
													<i class="la la-plus"></i>
													<span>
														Add News
													</span>
												</span>
                    </a>
                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                </div>
            </div>
        </div>
        @foreach($news as $news)
            @if($news->approval=='1')
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{$news->title}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                        {{$news->description}}
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-hover">
                                <tbody id="AddNewRow">
                                @foreach($news->comments as $comment)
                                    @if($comment->approval=='1')
                                        <tr id="item-{{ $comment->id }}">
                                            <td>{{$comment->comment}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <form method="post" action="{{route('comments')}}" id="AddCommentForm">
                    <textarea type="text" name="comment" id="comment" rows="5"
                              style="height: 2%; width: 99%"></textarea>
                        <input type="hidden" name="news_id" value="{{$news->id}}">
                        {!! csrf_field() !!}
                        <button type="button" name="submit"
                                class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30 btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill submit ">
                            Comment
                        </button>
                    </form>
                </div>
            @endif
        @endforeach

    @else
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Welcome
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                please Login to publish news. <a href="{{route('userLogin')}}">Login</a>
            </div>
        </div>
    @endif
@endsection


@section('scripts')
    <script>
        $('.submit').on('click', function () {
            var formData = new FormData($('#AddCommentForm')[0]);

            $.ajax({
                type: 'post',
                url: '/',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('.alert-danger').addClass('d-none');
                    $('.alert-success').removeClass('d-none');
                    setTimeout(function () {
                        $('.alert-success').addClass('d-none');
                    }, 9000);
                }, error: function (err) {
                    $('.alert-danger').removeClass('d-none');
                    var errors = err.responseJSON;
                    if (errors.errors.hasOwnProperty('comment')) {
                        $('.err-content').text(errors.errors.comment[0]);
                        setTimeout(function () {
                            $('.alert-danger').addClass(' d-none');
                        }, 3000);
                    }
                }

            });
        });
    </script>
@endsection