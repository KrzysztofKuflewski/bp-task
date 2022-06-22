@extends('layout')

@section('content')
    <div class="col-lg-4 offset-lg-4 mt-4">
        <div class="row justify-content-center">
            <h3>New Application</h3>

            <form id="create-application-form" method="post" action="{{ route('applications.store') }}"
                  enctype="multipart/form-data">

                {{csrf_field()}}

                <div class="form-group">
                    <label> First Name
                        <input class="form-control" type="text" id="first_name" name="first_name" required
                               maxlength="255">
                    </label>
                </div>
                <div class="form-group">
                    <label> Last Name
                        <input class="form-control" type="text" id="last_name" name="last_name" required
                               maxlength="255">
                    </label>
                </div>
                <div class="form-group">
                    <label> Attachment(s)
                        <input class="form-control" type="file" id="attachments" name="attachments[]"
                               multiple="multiple" accept="image/*">
                    </label>
                </div>

                <button type="submit" class="btn btn-primary submit my-2" style="margin-top:10px">Save</button>

                <div class="my-2">
                    <div class="alert alert-success success" style="display:none"></div>
                    <div class="alert alert-danger errors" style="display:none"></div>
                </div>

            </form>

            <div>
                <a href="{{ route('applications.index') }}">Go to applications list</a>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script type="text/javascript">
        $(document).ready(function () {
            $("#create-application-form").submit(function (event) {

                $('.alert').hide();
                $('.errors').hide();

                $.ajax({
                    type: "post",
                    url: $("form").attr('action'),
                    headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
                    data: getFormData(),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    encode: true,
                    success: function (data) {
                        $('.success').show().text(data.message);
                        $("#create-application-form").trigger('reset');
                    },
                    error: function (data) {
                        let message = (data.status === 422) ? getValidationErrorsHtmlList(data.responseJSON.errors) : "An error occurred. Try again.";
                        $('.errors').show().html(message);
                    },
                });

                event.preventDefault();
            });
        });

        function getFormData() {
            let formData = new FormData();
            formData.append("first_name", $("#first_name").val());
            formData.append("last_name", $("#last_name").val());

            let files = $("#attachments")[0].files;

            for (let i = 0; i < files.length; i++) {
                formData.append("attachments[]", files[i]);
            }

            return formData;
        }

        function getValidationErrorsHtmlList(errors) {
            let errorsHtml = "<ul>";

            for (let [key, value] of Object.entries(errors)) {
                errorsHtml += "<li>" + value + "</li>";
            }

            return errorsHtml + "</ul>";
        }
    </script>
@endsection
