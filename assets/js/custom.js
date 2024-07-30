// Select2
$(document).ready(function () {

    $("#mySelect").select2({
        // data: ['0000000','2323209333', '239483902', '20382932'], // Convert to Select2 format
        // placeholder: "Search Student ID",
        allowClear: false,
        minimumResultsForSearch: 5,
        theme: "classic"
    });
});

// Add an event listener for the form submission
document.getElementById('userForm').addEventListener('submit', function(event) {
    // Display a confirmation dialog
    var confirmSubmission = confirm("Are you sure you want to add this record?");
    // If the user clicks "Cancel", prevent the form from submitting
    if (!confirmSubmission) {
        event.preventDefault();
    }
});