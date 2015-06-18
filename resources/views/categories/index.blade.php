@extends('app')
@section('title', 'Categories')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categories
                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-xs pull-right">new category</a>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        {!! Form::open(['url' => "categories/{$category->id}", 'method' => 'delete']) !!}

                                        <a href="{{ route('categories.show', [$category->id]) }}" class="btn btn-xs btn-warning">details</a>
                                        <a href="{{ route('categories.edit', [$category->id])}}" class="btn btn-xs btn-success">edit</a>

                                        {!! Form::submit('delete', ['class' => 'btn btn-danger btn-xs']) !!}

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

