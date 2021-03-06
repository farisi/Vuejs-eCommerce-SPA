@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
@include('includes/messages.messages')
    @if(  Auth::user()->isAdmin() )
    @include('includes.errors')
    <h1>Hello, {{ Auth::user()->name }}</h1>
    <form class="form-horizontal" method="POST" action="/add-product" enctype="multipart/form-data">
        {{ csrf_field() }}

        {{--  NAME OF MEAL --}}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

            <label for="name" class="col-md-4 control-label">Product Name</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus required>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- DB row option_group_id --}}
        <div class="form-group{{ $errors->has('option_group_id') ? ' has-error' : '' }}">
            <label for="option" class="col-md-4 control-label">Option Group</label>
            <div class="col-md-6">
                <select id="option_group_id" class="form-control" name="option_group_id">
                    <option value="3">Please pick one</option>
                    <option value="1">option1</option>
                    <option value="2">option2</option>
                    <option value="3">option3</option>
                    {{-- @foreach($optionGroups as $optionGroup)
                        <option value="{{ $optionGroup->id }}">{{ $optionGroup->name }}</option>
                    @endforeach --}}
                </select>
            </div>
        </div>


        {{--  CATEGORY --}}
        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
            <label for="category_id" class="col-md-4 control-label">Category</label>
            <div class="col-md-6">
                <select id="category_id" class="form-control" name="category_id" value="{{ old('category_id') }}" autofocus required>
                    <option value="8">Please pick one</option>
                        <option value="1">category1</option>
                        <option value="2">category2</option>
                        <option value="3">category3</option>
                   {{--  @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach --}}
                @if ($errors->has('category_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                @endif
                </select>
            </div>
        </div>

        {{--  SLUG --}}
        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
            <label for="slug" class="col-md-4 control-label">Slug (ex: name-of-product)</label>

            <div class="col-md-6">
                <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}" required>

                @if ($errors->has('slug'))
                    <span class="help-block">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{--  DESCRIPTION --}}
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description</label>

            <div class="col-md-6">
                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required>

                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{--  PRICE --}}
        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <label for="price" class="col-md-4 control-label">Price</label>

            <div class="col-md-6">
                <input id="price" type="number" step="any" class="form-control" name="price" value="{{ old('price') }}" required>

                @if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{--  IMAGE --}}
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label for="image" class="col-md-4 control-label">Image</label>

            <div class="col-md-6">
                <input id="image" type="file" accept="image/png, image/jpg"  class="form-control" name="image" value="{{ old('image') }}" required>
                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <input type=submit value='Submit' class="btn btn-primary">
            </div>
        </div>
    </form>

    <form class="form-horizontal" method="get" action="/logout">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-md-12">
                <input type=submit value='logout' class="btn btn-danger">
            </div>
        </div>
    </form>


    <div class="container">

        <ul class=list-group>
            @if(Auth::user()->theboss)
                <li class="list-group-item"><a href="/admin/messages" class="btn btn-primary">View all</a></li>
                @foreach( $messages as $message )
                    <li class="list-group-item"><h4>Latest messages: {{ $message->email }}</h4>{{ $message->name }} said {{ $message->body }} on <strong>{{ $message->created_at->toFormattedDateString() }}</strong> at {{    $message->created_at->toTimeString() }}</li>
                @endforeach
            @endif

        </ul>
    </div>

    @elseif( !Auth::user()->isAdmin() )
        <script type="text/javascript">
            window.location = "{{ url('/shop') }}";
        </script>
    @endif
    <div class="spacer"></div>
@endsection
