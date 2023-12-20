<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Selection</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>

<div style="text-align: center">
    <label for="medicineSelect">Medicine Name</label>
    <select class="mySelect" id="medicineSelect" name="state">
        <option value="">Select a option</option>
    </select>
</div>

<script>
var timeout;

$('#medicineSelect').select2({
    placeholder: 'Select an option',
    ajax: {
        method: 'GET',
        url: 'get_medicine_names.php',
        data: function (params) {
            return {
                input: params.term,
            };
        },
        processResults: function (data) {
            return {
                results: data.results,
            };
        },
        cache: true,
        // Debounce the input
        // this process is used for reduce the user waiting time
        //input minimum lenght will be 1
        delay: 250,
        transport: function (params, success, failure) {
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                return $.ajax(params).then(success).fail(failure);
            }, 250);
        }
    },
    minimumInputLength: 1, // Adjust as needed
});


    // $(document).ready(function () {
    //     // Initialize Select2
    //     $('#medicineSelect').select2({
    //         placeholder: 'Select an option',
    //         ajax: {
    //             method: 'GET',
    //             url: 'get_medicine_names.php',
    //             //dataType: 'json',
    //             delay: 1000,
    //             data: function (params) {
    //                 return {
    //                     input: params.term,  // Send the typed input to the server
    //                 };
    //             },
    //             processResults: function (data) {
    //                 console.log(data)
    //                 return {
    //                     results: data.results, // Parse the JSON data from the server
    //                 };
    //             },
    //             cache: true
    //         }
    //     });
    // });
</script>


</body>
</html>
