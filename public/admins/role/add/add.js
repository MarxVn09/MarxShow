$(function (){
    $('.checkBox_wrapper').on('click',function (){
        $(this).parents('.card').find('.checkBox_childrent').prop('checked',$(this).prop('checked'))
    })
    $('.check_all').on('click',function (){
        $(this).parents().find('.checkBox_childrent').prop('checked',$(this).prop('checked'))
        $(this).parents().find('.checkBox_wrapper').prop('checked',$(this).prop('checked'))
    })
})

