<div class="form-group">
    {!! Form::label('category', 'Category', ['class' => 'control-label']) !!}
    {!! Form::select('category', $categories , 0 , ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', '', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('quantity', 'Quantity', ['class' => 'control-label']) !!}
    {!! Form::text('quantity', '', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
    {!! Form::text('description', '', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('available', 'Available', ['class' => 'control-label']) !!}
    {!! Form::select('available', [0 => 'No', 1 => 'Yes'] , 1 , ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
    {!! Form::select('active', [0 => 'No', 1 => 'Yes'] , 1 , ['class' => 'form-control']) !!}
</div>
{!! Form::submit($button, ['class' => 'form-control']) !!}