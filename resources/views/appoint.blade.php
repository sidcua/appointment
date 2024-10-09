@extends('layouts.appoint')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 justify-content-center">
            <form class="row g-3 needs-validation" novalidate>
                <div class="col-md-12 input-group-lg">
                    <label for="select-application" class="form-label">Type of Application</label>
                    <select name="application" class="form-select" id="select-application" required disabled>
                        <option selected disabled value="">Select an application...</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a request.
                    </div>
                    <div class="valid-feedback">
                        Looks Good!
                    </div>
                </div>
                <div class="col-md-4 input-group-lg">
                    <label for="validationCustom01" class="form-label">First name</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input your first name.
                    </div>
                </div>
                <div class="col-md-4 input-group-lg">
                    <label for="validationCustom02" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="validationCustom02" value="">
                </div>
                <div class="col-md-4 input-group-lg">
                    <label for="validationCustom02" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="validationCustom02" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input your last name.
                    </div>
                </div>
                <div class="col-md-8 input-group-lg">
                    <label for="validationCustom02" class="form-label">Program / Course</label>
                    <input type="text" class="form-control" id="validationCustom02" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input your course.
                    </div>
                </div>
                <div class="col-md-4 input-group-lg">
                    <label for="validationCustom02" class="form-label">Birthdate</label>
                    <input type="date" class="form-control" id="validationCustom02" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input your birthdate.
                    </div>
                </div>
                <div class="col-md-6 input-group-lg">
                <label for="validationCustom03" class="form-label">Email</label>
                <input type="email" class="form-control" id="validationCustom03" required>
                    <div class="invalid-feedback">
                        Please provide a valid email.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 input-group-lg">
                    <label for="validationCustom05" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" id="validationCustom05" required>
                    <div class="invalid-feedback">
                        Please provide a valid mobile number.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-12 input-group-lg">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                        I agree on providing my information per RA 10173 or the Data Privacy Act (DPA) of 2012
                        </label>
                        <div class="invalid-feedback">
                        You must agree before submitting.
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-lg btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })
    })()

    $(document).ready(function() {
        // load dropdowns and initialization
        loadDropDownApplication()
    })

    function loadDropDownApplication() {
        $.ajax({
            url: '{{ route("dropdown-application") }}',
            method: 'get',
            beforeSend: function() {
                $("#select-application").prop("disabled", true);
                $("#select-application").html('<option selected disabled value="">Select a application...</option>');
            },
            success: function(response) {
                $.each(response, function (key, value) {
                    $("#select-application").append('<option value="' + value.applicationID + '">' + value.application + '</option>');
                });
                $("#select-application").prop("disabled", false);
            }
        })
    }
</script>
@endsection