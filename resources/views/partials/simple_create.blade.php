<div class="form-group">
    {!! Form::label($field, $text, ['class' => 'control-label']) !!}
    {!! Form::text($field, null, ['class' => 'form-control']) !!}
</div>
{!! Form::submit($button, ['class' => 'btn btn-default']) !!}