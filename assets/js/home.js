$(document).ready(function()
{
    $.get(baseurl + 'plats/liste_plats/p=ajax',
    function(data)
    {
        $('.main .food-container').html(data)
    })
})