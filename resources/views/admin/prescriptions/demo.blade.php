@extends('')

@section('title')

@endsection

@section('before-path')

@endsection

@section('breadcrumb-name')

@endsection

@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="col-md-9">
        <div class="form-row med_selected" style="background: #D9D9D9" id="med_selected_section-' + med_id + '">
            <div class=col-md-2>
                <div class="form-group">
                    <label for="med_id"> Medicine </label>
                    <input class="form-control" name="med_id[]" value="' + med_name + '"
                           placeholder="" required id="med_id">
                    <input type="hidden" class="medi_div form-control"
                           id="med_id-' + id + '"
                           name="medicine[]" value="' + med_id + '" placeholder=""
                           required>
                </div>
            </div>
            <div class=col-md-2>
                <div class="form-group">
                    <label for="med_category"> Category </label>
                    <select id="med_category" name="med_category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class=col-md-2>
                <div class="form-group">
                    <label for="dosage">Dosage</label>
                    <input class="form-control" name="dosage[]"
                           value="" placeholder="100 mg" id="dosage" required>
                </div>
            </div>
            <div class=col-md-2>
                <div class="form-group">
                    <label for="frequency">Frequency</label>
                    <input class="form-control"
                           id="frequency" name="frequency[]"
                           value="" placeholder="1 + 0 + 1" required>
                </div>
            </div>
            <div class=col-md-2>
                <div class="form-group">
                    <label for="days">Days</label>
                    <input class="form-control"
                           id="days" name="days[]"
                           value="" placeholder="7 days" required>
                </div>
            </div>
            <div class=col-md-2>
                <div class="form-group">
                    <label for="instruction">Instruction</label>
                    <input class="form-control"
                           id="instruction"
                           name="instruction[]" value=""
                           placeholder="After Food" required>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
