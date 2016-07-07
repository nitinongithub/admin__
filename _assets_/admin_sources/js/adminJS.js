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
            //$("#" + id + "g").hide();
            $.ajax({
                url: site_url_ + "/gallery/deleteimg",
                data: 'id=' + id,
                type: 'POST'
            }).done(function (data) {
                loadgallery(dataCmb);
            });
        });

        var btnActive = $("#gallery").find($(".btn-active"));

        (btnActive).on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: site_url_ + "/gallery/activeImg",
                data: 'id=' + id,
                type: 'POST'
            }).done(function (data) {
                loadgallery(dataCmb);
            });
        });
        
        var btnInactive = $("#gallery").find($(".btn-inactive"));

        (btnInactive).on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: site_url_ + "/gallery/InactiveImg",
                data: 'id=' + id,
                type: 'POST'
            }).done(function (data) {
                loadgallery(dataCmb);
            });
        });
        
        var btnActive = $("#myUpload").find($(".btn-Submit"));

        (btnActive).on('click', function (e) {
            e.preventDefault();
            var id = dataCmb.value;
            $.ajax({
                url: site_url_ + "/gallery/do_upload",
                data: 'id=' + id,
                type: 'POST'
            }).done(function(data) {
                loadgallery(dataCmb);
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

function change_Report(id_, val_, path_) {
    document.getElementById('txtReportYear_edit').value = val_;
    document.getElementById('txtID_edit').value = id_;
    $("#Plist").html(path_);
     $("a[href='mylist']").attr('href', base_url_ + "_assets_/annualReport/" + path_);
    document.getElementById('editCat').style.display = 'block';
    document.getElementById('newCat').style.display = 'none';
}