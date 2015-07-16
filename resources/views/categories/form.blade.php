<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
    {!! Form::select('active', [0 => 'No', 1 => 'Yes'] , null, ['class' => 'form-control']) !!}
</div>
{!! Form::submit($button, ['class' => 'btn btn-default']) !!}