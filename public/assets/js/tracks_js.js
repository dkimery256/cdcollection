$("document").ready(function(){

    //Get user selected track amount and generate track inputs
    $('#select_click').click(function(){
    $('#select_form').empty();
    var select = $('#addtracks').val();
    var track_id = $('#track_id').html();
    var album = $('#album').html();
    $.get('/inputs/track_inputs', { 'tracks': select, 'track_id': track_id, 'album': album },
        function(data, status){        
            $('#select_form').html(data);
            $('#select_tracks').empty();
        });
    });
});