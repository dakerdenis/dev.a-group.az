@extends('layouts.backend')
@section('content')

    @include('backend.partials.title_breadcrumbs', ['title' => isset($block) ? 'Update ' . $block->title : 'Create About Us Block', 'breadcrumbs' => [['active' => false, 'title' => 'Blocks', 'link' => route('backend.blocks.index')],], 'buttons' => null])
    <form
        action="{{isset($block) ? route('backend.blocks.update', ['block' => $block->id]) : route('backend.blocks.store')}}"
        method="post" enctype='multipart/form-data'>
        <input type="hidden" name="type" value="{{$type ?? $block->type}}">
        @method(isset($block) ? 'put' : 'post')
        @csrf
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (Session::has('message'))
                        <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                            <strong>{!! Session::get('message')['type'] !!}
                                ! </strong> {!! Session::get('message')['message'] !!}
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"
                                    data-original-title="" title=""><span aria-hidden="true">×</span></button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                                            <li class="nav-item">
                                                <a class="nav-link {{$loop->first ? 'active' : ''}}"
                                                   id="{{ $localeCode }}-tab" data-bs-toggle="tab"
                                                   href="#{{ $localeCode }}" role="tab"
                                                   aria-controls="{{ $localeCode }}"
                                                   aria-selected="true">{{ mb_convert_case($properties['native'], MB_CASE_TITLE, "UTF-8") }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                                            <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}"
                                                 id="{{$localeCode}}" role="tabpanel"
                                                 aria-labelledby="{{$localeCode}}-tab">
                                                <div class="mb-0 m-t-30">
                                                    <div class="form-group">
                                                        <label for="title" class="col-form-label">Title</label>
                                                        <input
                                                            class="form-control @error('title:'.$localeCode)is-invalid @enderror "
                                                            type="text" name="title:{{$localeCode}}"
                                                            placeholder="use @@text@@ to bold text"
                                                            value="{{old('title:'.$localeCode, (isset($block) && $block->translate($localeCode)) ? $block->translate($localeCode)->title : '')}}"
                                                            id="title">
                                                        @error('title:'.$localeCode)
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>@enderror
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 form-group mt-3">
                                                            <label for="data:{{$localeCode}}[first_title]" class="col-form-label">First Title</label>
                                                            <input
                                                                class="form-control"
                                                                type="text" name="data:{{$localeCode}}[first_title]"
                                                                value="{{old('data:'.$localeCode.'.first_title', (isset($block) && $block->translate($localeCode)) ? $block->translate($localeCode)->data['first_title'] : '')}}"
                                                                id="data:{{$localeCode}}[first_title]">
                                                        </div>
                                                        <div class="col-md-6 form-group mt-3">
                                                            <label for="data:{{$localeCode}}[first_value]" class="col-form-label">First Value</label>
                                                            <input
                                                                class="form-control"
                                                                type="text" name="data:{{$localeCode}}[first_value]"
                                                                value="{{old('data:'.$localeCode.'.first_value', (isset($block) && $block->translate($localeCode)) ? $block->translate($localeCode)->data['first_value'] : '')}}"
                                                                id="data:{{$localeCode}}[first_value]">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 form-group mt-3">
                                                            <label for="data:{{$localeCode}}[second_title]" class="col-form-label">Second Title</label>
                                                            <input
                                                                class="form-control"
                                                                type="text" name="data:{{$localeCode}}[second_title]"
                                                                value="{{old('data:'.$localeCode.'.second_title', (isset($block) && $block->translate($localeCode)) ? $block->translate($localeCode)->data['second_title'] : '')}}"
                                                                id="data:{{$localeCode}}[second_title]">
                                                        </div>
                                                        <div class="col-md-6 form-group mt-3">
                                                            <label for="data:{{$localeCode}}[second_value]" class="col-form-label">Second Value</label>
                                                            <input
                                                                class="form-control"
                                                                type="text" name="data:{{$localeCode}}[second_value]"
                                                                value="{{old('data:'.$localeCode.'.second_value', (isset($block) && $block->translate($localeCode)) ? $block->translate($localeCode)->data['second_value'] : '')}}"
                                                                id="data:{{$localeCode}}[second_value]">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="slug" class="col-form-label">Image</label>
                                                <input type="hidden" name="delete_images[]" id="deleteImages">
                                                <input type="hidden" name="preview_url" class="url" id="preview_url">
                                                <input type="file"
                                                       data-file-id="{{isset($block) && $block->getFirstMedia('preview') ? $block->getFirstMedia('preview')->id : '' }}"
                                                       name="preview" id="input-file-now" class="dropify"
                                                       data-default-file="{{isset($block) && $block->getFirstMediaUrl('preview') ? $block->getFirstMediaUrl('preview') : '' }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        class="btn btn-primary">{{isset($block) ? 'Update' : 'Create'}}</button>
                                    <a style="color: white" href="{{route('backend.blocks.index')}}"
                                       class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </form>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('backend/assets/css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/dragula.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/vendors/date-picker.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('backend/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('backend/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{ asset('backend/assets') }}/js/dragula.min.js"></script>
    <script src="{{ asset('backend/assets') }}/js/editor/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('backend/assets') }}/js/editor/ckeditor/adapters/jquery.js"></script>
    <script src="{{ asset('backend/assets') }}/js/editor/ckeditor/styles.js"></script>
    <script src="{{ asset('backend/assets') }}/js/dropify.min.js"></script>
@endsection