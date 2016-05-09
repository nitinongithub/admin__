function  loadgallery(dataCmb) {
    $.ajax({
        url: site_url_ + "/gallery/fillGallery/" + dataCmb.value,
        type: 'GET'
    }).done(function (data) {
        $("#gallery").html(data);
        var btnDelete = $("#gallery").find($(".btn-delete"));

        (btnDelete).on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $("#" + id + "g").hide();
            $.ajax({
                url: site_url_ + "/gallery/deleteimg",
                data: 'id=' + id,
                type: 'POST'
            }).done(function (data) {
            });
        });

    });
}

function change_Cat(id_, val_, val2_) {
    document.getElementById('txtCategory_edit').value = val_;
    document.getElementById('txtDesc_edit').value = val2_;
    document.getElementById('txtID_edit').value = id_;
    document.getElementById('editCat').style.display = 'block';
    document.getElementById('newCat').style.display = 'none';
}

//function selectCat() {
//  data_ = $("#frmupload").serialize();    
// url_ = site_url_ + "/admin_/getImages";   

//$('#loadGallery').css({'color': '#ff0000', 'font-size': '13px'});
//$('#loadGallery').html('loading Gallery. Please wait...');
//$.ajax({
//  type: "POST",
// url: url_,
//data: data_,
//success: function (data) {
//  $('#loadGallery').html(data);
//}
//});
//}

//function uploadImg() {
//   data_ = $("#frmupload").serialize();    
// url_ = site_url_ + "/admin_/uploadGallery";   

//$('#loadGallery').css({'color': '#ff0000', 'font-size': '13px'});
//$('#loadGallery').html('loading Gallery. Please wait...');
//$.ajax({
//  type: "POST",
// url: url_,
//data: data_,
//success: function (data) {
//  $('#loadGallery').html(data);
//}
//});
//}