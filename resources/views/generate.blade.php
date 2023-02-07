@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
    <form action="{{ route( 'category.store' )}}" method="POST">
        @csrf

                <div class="form-group">
                    <label for="category_name">CATEGORY NAME</label>
                    <input type="text" name="category_name" class="form-control-sm focus">
                </div>




        <button class="btn" type="submit">Create</button>
    </form>
</div>
</div>
@endsection


