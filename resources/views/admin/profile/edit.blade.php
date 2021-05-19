@extends('layouts.admin')
@section('title', 'プロフィール編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール編集</h2>
                <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">氏名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $profile_form->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="gender" class="col-sm-4 col-form-label text-md-right">性別</label>

                                <div class="col-md-6" style="padding-top: 8px">
                                    <input id="gender-m" type="radio" name="gender" value="male"{{ $exaple->like == 'male' ? 'checked' : '' }}>
                                        <label for="gender-m">男性</label>
                                    <input id="gender-f" type="radio" name="gender" value="female"{{ $exaple->like == 'female' ? 'checked' : '' }}>
                                        <label for="gender-f">女性</label>

                    @if ($errors->has('gender'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                             @endif
                        </div>
                </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">趣味</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="hobby" rows="10">{{ $profile_form->hobby }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">自己紹介</label>
                        <div class="col-md-10">
                        <textarea class="form-control" name="introduction" rows="14">{{ $profile_form->introduction }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profile_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection