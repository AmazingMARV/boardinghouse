@extends('layouts.owner')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="mb-3">Apartment / Boarding House Information</h3>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="bhouse_name" name="bhouse_name" placeholder="Enter">
                    <label for="bhouse_name">Name of the Bhouse/Apartment</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Description</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">House Rules</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload photo of your boarding house/apartment</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Location">
                    <label for="floatingInput">Location Description</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Location">
                    <label for="floatingInput">Location X</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Location">
                    <label for="floatingInput">Location Y</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" style="padding:5px 30px;">Save</button>
            </div>
        </div>

    </div> <!--container-->
@endsection