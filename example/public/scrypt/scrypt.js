console.log('Привет, Мир!');


// function renderGoods()
// {
//     // alert('gdsgzd');
//     let xhr = new XMLHttpRequest();
//     xhr.open('GET', '../?c=page', true);
//     xhr.setRequestHeader('Content-type', 'application/x-form-urlencode');
//     xhr.onreadystatechange = function () {
//         if(xhr.readyState == 4 && xhr.status == 200){
//             alert('gdsgzd');
//             document.getElementById('catalog').innerHTML = xhr.responseText;
//         }
//     }
//     xhr.send();
// }
// renderGoods();
$(function(){
    $('#showmore-btn').click(function (){
        var $target = $(this);
        var page = $target.attr('data-page');
        page++;

        $.ajax({
            url: '/good/ajax/?page=' + page,
            dataType: 'html',
            success: function(data){
                // alert(page);
                // alert(data);
                $('#catalog').append(data);
            }
        });
        // alert(page);
        $target.attr('data-page', page);
        if (page ==  $target.attr('data-max')) {
            $target.hide();
        }

        return false;
    });
});
