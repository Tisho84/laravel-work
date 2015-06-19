<div class="form-group">
    {!! Form::label('name', 'Payment', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('info', 'More info', ['class' => 'control-label']) !!}
    {!! Form::hidden('info', 0) !!}
    {!! Form::checkbox('info', 1) !!}

</div>
{!! Form::submit($button, ['class' => 'btn btn-default']) !!}