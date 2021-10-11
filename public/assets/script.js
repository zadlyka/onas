$(document).ready(function () {
    $("#nilaibtn").click(function () {
        $('#nilaiform').val($(this).data('nilai'));
        $('#assignidnilai').val($(this).data('assignid'));
        $('#roomidnilai').val($(this).data('roomid'));
        $('#nilaiModal').modal('show');
    });
});