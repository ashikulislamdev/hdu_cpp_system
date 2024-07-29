// Select2
$(document).ready(function () {

    $("#mySelect").select2({
        // data: ['0000000','2323209333', '239483902', '20382932'], // Convert to Select2 format
        // placeholder: "Search Student ID",
        allowClear: false,
        minimumResultsForSearch: 5
    });
});