<div class="form-group">
    {!! Form::label('first_name', 'First name', ['class' => 'control-label']) !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('last_name', 'Last name', ['class' => 'control-label']) !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>
<div class='form-group'>
    {!! Form::label('username', 'Username', ['class' => 'control-label']) !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>
<div class='form-group'>
    {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>
@if(Auth::user()->is_admin)
    <div class='form-group'>
        <div class="form-group">
            {!! Form::label('active', 'active', ['class' => 'control-label']) !!}
            {!! Form::select('active', [0 => 'No', 1 => 'Yes'] , null, ['class' => 'form-control']) !!}
        </div>
    </div>
@endif
<div class="form-group">
    {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', 'Password confirmation', ['class' => 'control-label']) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>
{!! Form::submit($button, ['class' => 'btn btn-default']) !!}