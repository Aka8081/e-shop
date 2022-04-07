@extends('admin.main')


@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add products</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-products') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12 md-3">
                    <select class="form-select" name="cate_id">
                        <option value="">select a category</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Slug</label>
                    <input type="text" class="form-control" name="slug">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description" rows="3" class="form-control"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Original Price</label>
                    <input type="number" class="form-control" name="original_price">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">selling Price</label>
                    <input type="number" class="form-control" name="selling_price">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">tax</label>
                    <input type="number" class="form-control" name="tax">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Quantity</label>
                    <input type="number" class="form-control" name="qty">
                </div>

                <div class="col-md-6 mb-3">
                    <label for=""> Status</label>
                        <input type="checkbox" name="status">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">trending</label>
                    <input type="checkbox" name="trending">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title">
                </div>

                <div class="col-md-12 mb-3">
                    <label for=""> Meta Keywords</label>
                    <textarea name="meta_keywords" rows="3" class="form-control"></textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control"></textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Small Description</label>
                    <textarea name="small_description" rows="3" class="form-control"></textarea>
                </div>

                <div class="col-md-12">
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>

        </form>

    </div>

</div>
@endsection

@section('scripts')

<script>

$("#edit_upc").attr("maxlength", "12");
    $("#edit_upc").keypress(function(e) {
        var kk = e.which;
        if (kk < 48 || kk > 57) {
            e.preventDefault();
            $("#eupc_err").show();
            $("#eupc_err").html("**only numbers allowed");
            $("#eupc_err").focus();
            $("#eupc_err").css("color", "red");
        } else {
            $("#eupc_err").hide();
        }
    });


</script>
@endsection