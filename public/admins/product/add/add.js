
$(function () {
    $(".tags_select_choose").select2({
        tags: true,
        tokenSeparators: [',']
    })
});
$(function () {
    $(".select2_init").select2({
        placeholder: "Select Category",
        allowClear: true
    })
})
var editor = new FroalaEditor('#contents');
