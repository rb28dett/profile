@extends('rb28dett::layouts.master')
@section('icon', 'ion-edit')
@section('title', trans('rb28dett_profile::general.edit_profile'))
@section('subtitle', trans('rb28dett_profile::general.edit_profile_desc'))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('rb28dett::index') }}">@lang('rb28dett_profile::general.home')</a></li>
        <li><a href="{{ route('rb28dett::profile.index') }}">@lang('rb28dett_profile::general.profile')</a></li>
        <li><span href="">@lang('rb28dett_profile::general.edit_profile')</span></li>
    </ul>
@endsection
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
            <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('rb28dett_profile::general.edit_profile') ({{ $user->email }})
                    </div>
                    <div class="uk-card-body">
                        <form method="POST" class="uk-form-stacked" enctype="multipart/form-data" action="{{ route("rb28dett::profile.update") }}">
                            {{ csrf_field() }}
                            <fieldset class="uk-fieldset">
                                {{-- <div class="uk-margin">
                                    <label class="uk-form-label">@lang('rb28dett_profile::general.save_picture')</label>
                                    <div class="uk-form-controls">
                                        <label>
                                            <input class="uk-checkbox" name="save_picture" id="save_picture" type="checkbox" @if(old('save_picture', $user->hasAvatar())) checked @endif>
                                            @lang('rb28dett_profile::general.save_picture')
                                        </label>
                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('rb28dett_profile::general.profile_picture')</label>
                                    <div class="uk-form-controls">
                                        <div uk-form-custom="target: true" class="uk-width-1-1">
                                            <input class="file" name="picture" type="file">
                                            <input class="uk-input" type="text" placeholder="@lang('rb28dett_profile::general.browse_file')" disabled>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('rb28dett_profile::general.name')</label>
                                    <input value="{{ old('name', $user->name) }}" name="name" class="uk-input" type="text" placeholder="@lang('rb28dett_profile::general.name')">
                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('rb28dett_profile::general.password')</label>
                                    <input name="password" class="uk-input" type="password" placeholder="@lang('rb28dett_profile::general.password')">
                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('rb28dett_profile::general.password_confirmation')</label>
                                    <input name="password_confirmation" class="uk-input" type="password" placeholder="@lang('rb28dett_profile::general.password_confirmation')">
                                </div>

                                <hr class="uk-divider-icon">

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('rb28dett_profile::general.current_password')</label>
                                    <input name="current_password" class="uk-input" type="password" placeholder="@lang('rb28dett_profile::general.current_password')">
                                </div>

                                <div class="uk-margin">
                                    <a href="{{ route('rb28dett::profile.index') }}" class="uk-align-left uk-button uk-button-default">@lang('rb28dett_profile::general.cancel')</a>
                                    <button type="submit" class="uk-button uk-button-primary uk-align-right">
                                        <span class="ion-forward"></span>&nbsp; @lang('rb28dett_profile::general.submit')
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(function () {
            $('.file').click(function () {
                $('#save_picture').attr('checked', true);
            });
        });
    </script>
@endsection
