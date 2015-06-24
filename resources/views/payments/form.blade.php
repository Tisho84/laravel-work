@if($action == 'store')
    <div class="form-group">
        {!! Form::label('type_id', 'Payment Type', ['class' => 'control-label']) !!}
        {!! Form::select('type_id', $types, null , ['class' => 'form-control']) !!}
    </div>
@endif
<div class="more-info">
    <div class="form-group">
        {!! Form::label('brand', 'Brand', ['class' => 'control-label']) !!}
        {!! Form::text('brand', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('exp_year', 'Exp year', ['class' => 'control-label']) !!}
        {!! Form::text('exp_year', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('exp_month', 'Exp month', ['class' => 'control-label']) !!}
        {!! Form::text('exp_month', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('last4', 'Last 4', ['class' => 'control-label']) !!}
        {!! Form::text('last4', null, ['class' => 'form-control']) !!}
    </div>
</div>
{!! Form::submit($button, ['class' => 'btn btn-default']) !!}