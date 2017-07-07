$(document).ready(function() {
    
    if(typeof defaultTime !== 'undefined')
    {
        $('#tweet-datetimepicker').datetimepicker({defaultDate: moment(defaultTime), format: 'YYYY-MM-DD HH:mm'});
    }
    else
    {
        $('#tweet-datetimepicker').datetimepicker({defaultDate: moment(), format: 'YYYY-MM-DD HH:mm'});
    }
    
    

    var tweetTextMaxChar = 140;
    function countCharacters(){
        charCount = $('#tweet-text').val().length;
        charLeft = tweetTextMaxChar - charCount;
        $('#charCount').html(charLeft);
    }

    countCharacters();

    $('#tweet-text').keyup(countCharacters);


});