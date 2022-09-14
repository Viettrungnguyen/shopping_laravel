$(function () {
    $(".tags_select-choose").select2({
        tags: true,
        //mang bao gom nhung ky tu ket thuc tag
        tokenSeparators: [',']
    });
    $(".select2_init").select2({
        placeholder: "chon danh muc",
        allowClear: true
    });
});


