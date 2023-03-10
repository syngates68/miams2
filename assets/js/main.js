$(document).ready(function()
{
    var navbar = $('.navbar')[0].offsetHeight
    //var footer = $('footer')[0].offsetHeight
    
    $('.main-login').css('height', 'calc(100% - ' + navbar + 'px)')
})

$(document).on('click', '.open-informations-food', function()
{
    var id_plat = $(this).attr('data-id')

    $.get(baseurl + 'plats/informations_plat/' + id_plat + '/p=ajax',
    function(data)
    {
        $('#foodinformations .modal-content').html(data)
    })
})

$(document).on('click', '.show-user-reviews', function()
{
    var id_vendeur = $(this).attr('data-user')

    $.get(baseurl + 'utilisateur/avis_recus/' + id_vendeur + '/p=ajax',
    function(data)
    {
        $('#ratingslist .modal-content').html(data)
    })
})

$(document).on('click', '.btn-reserver', function()
{
    var id_plat = $(this).attr('data-id')

    $.get(baseurl + 'plats/reservation/' + id_plat + '/p=ajax',
    function(data)
    {
        if (data != '')
            $('#foodinformations .modal-content').html(data)
        else
            window.location = baseurl
    })
})

$(document).on('change', '#nbr_parts', function()
{
    var prix = $(this).attr('data-prix')
    var total = $(this).val() * prix
    $('.total-reservation').html(total)
})

$(document).on('submit', '.reservation-form form', function()
{
    $('.btn-validation').css('display', 'none')
    $('.btn-loading').css('display', 'block')

    var action = $('.reservation-form form').attr('action')
    var parts = $('input[name="nbr_parts"]').val()
    var id_plat = $('input[name="id_plat"]').val()

    $.post(action + '/p=ajax',
    {
        id_plat: id_plat,
        parts: parts
    },
    function(data)
    {
        if (data.substring(0, 1) == '0')
        {
            $('.error-message').css('display', '').html(data.substring(1, data.length))
            $('.btn-validation').css('display', 'block')
            $('.btn-loading').css('display', 'none')
        }
        else
        $.get(baseurl + 'plats/succes_reservation/' + data + '/p=ajax',
        function(data)
        {
            $('#foodinformations .modal-content').html(data)
        })
    })

    return false
})

$(document).on('click', '.modify-avatar', function()
{
    $('input[name="avatar"]').click()
})

$(document).on('change', 'input[name="avatar"]', function()
{
    readURL(this)
})

function readURL(input)
{
    if (input.files && input.files[0]) {

        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();

        if (ext == "png" || ext == "jpeg" || ext == "jpg")
        { 
            var reader = new FileReader();
          
            reader.onload = function(e) 
            {
                $('.edit-block .avatar-container img').attr('src', e.target.result)
            }
            
            reader.readAsDataURL(input.files[0]);
        }
        else
        {
            alert('Vous devez choisir une image au format .jpg, .png ou .jpeg');
        }
    }
}