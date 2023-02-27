@extends(backpack_view('blank'))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>Archivo BSE</h3><br>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Archivo TXT:</label>
                    <textarea class="form-control" name="txt"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Subir</button>
            </form>
        </div>
    </div>
</div>

@endsection

