<div class="form-group">
    {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
    {!! Form::select('category_id', $categories , null , ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div>
    {!! Form::label('price', 'Price', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('quantity', 'Quantity', ['class' => 'control-label']) !!}
    {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('available', 'Available', ['class' => 'control-label']) !!}
    {!! Form::select('available', [0 => 'No', 1 => 'Yes'] , null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
    {!! Form::select('active', [0 => 'No', 1 => 'Yes'] , null, ['class' => 'form-control']) !!}
</div>
{!! Form::submit($button, ['class' => 'form-control']) !!}