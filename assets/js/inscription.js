$('#pass').on('keyup change', function()
{
    var password = $('#pass').val()

    if (password.length >= 6)
        $('#password_length').removeClass('not-good').addClass('good')
    else
        $('#password_length').removeClass('good').addClass('not-good')
    
    if (password.match(/\d/))
        $('#password_number').removeClass('not-good').addClass('good')
    else
        $('#password_number').removeClass('good').addClass('not-good')
    
    if (password.match('[A-Z]'))
        $('#password_upper').removeClass('not-good').addClass('good')
    else
        $('#password_upper').removeClass('good').addClass('not-good')
    
    if (password.match('[a-z]'))
        $('#password_lower').removeClass('not-good').addClass('good')
    else
        $('#password_lower').removeClass('good').addClass('not-good')
    
    if (password.match(/[_!@#$%\^&*(){}[\]<>?/|\-]/))
        $('#password_special').removeClass('not-good').addClass('good')
    else
        $('#password_special').removeClass('good').addClass('not-good')
})

$('.show-password a').on('click', function(e)
{
    e.preventDefault()

    var input = $(this).attr('data-pass')

    var type = 'text'
    var text = 'Masquer'
    var status = 'visible'

    if ($(this).attr('data-status') == 'visible')
    {
        type = 'password'
        text = 'Afficher'
        status = 'hidden'
    }

    $('#' + input).attr('type', type)
    $(this).text(text)
    $(this).attr('data-status', status)
})