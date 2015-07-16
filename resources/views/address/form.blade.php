<div class="form-group">
    {!! Form::label('type', 'Address Type', ['class' => 'control-label']) !!}
    {!! Form::select('type', $types, null , ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('country', 'Country', ['class' => 'control-label']) !!}
    {!! Form::text('country', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('city', 'City', ['class' => 'control-label']) !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('street', 'Street', ['class' => 'control-label']) !!}
    {!! Form::text('street', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('zip', 'Zip', ['class' => 'control-label']) !!}
    {!! Form::text('zip', null, ['class' => 'form-control']) !!}
</div>
{!! Form::submit($button, ['class' => 'btn btn-default']) !!}