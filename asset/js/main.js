$(document).ready(function () {
    $('button#toggleButton').on("click",function () {
        $(".side-left").toggleClass('open-side-left');
    })
    $(document).on("click","#buttonModal",function (e) {
        e.preventDefault();
        var url=$(this).attr("href");
        $.ajax({
            url:url,
            type:'GET',
            dataType:'HTML',
            cache:false,
            success:function (e) {
                $("#exampleModal").html(e).modal("show");
            }
        });
    })
    $(document).on("click","a#hapusbtn",function (e) {
        e.preventDefault();
        var url=$(this).attr("href");
        $.ajax({
            url:url,
            type:'GET',
            dataType:'JSON',
            cache:false,
            success:function (e) {
                if (e=="Success"){
                    setTimeout(function () {
                        location.reload();
                    },200);
                }else if (e=="Failed"){
                    alert("Error Delete data!");
                }
            }
        });
    })
    $(document).on("submit","form#submit",function (e) {
        e.preventDefault();
        var data=$(this).serialize();
        var url=$(this).attr("action");
        $.ajax({
            url:url,
            data:data,
            dataType:'JSON',
            type:'POST',
            cache:false,
            beforeSend:function () {
              $("#btn-Process").html("<i class=\"fa fa-circle-notch fa-spin\"></i> Process..")
            },
            statusCode:{
              404:function () {
                  alert("page not found");
                  location.reload();
              }
            },
            success:function (e) {
                if (e=="Success"){
                  setTimeout(function () {
                      location.reload();
                  },200);
                }else if (e=="Failed"){
                    alert("Error Saving data!");
                }
            }
        })
    })
    $(document).on('submit','form#getData', function(e) {
        e.preventDefault();
        var url=$(this).attr('action');
        var data=$(this).serialize();
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success:function(e){
                if (e=='Success') {
                    $('#Data').load('../serverside/loadDataTable');
                    $('a#print').removeClass('disabled');
                }else{
                    alert('Failed');
                }
            }
        });
    });
    $(document).on("click","#buttonSave",function (e) {
        e.preventDefault();
        var url=$(this).attr("href");
        $.ajax({
            url:url,
            type:'GET',
            dataType:'JSON',
            cache:false,
            beforeSend:function () {
                $(this).html("<i class=\"fa fa-circle-notch fa-spin\"></i>")
            },
            success:function(e){
                if (e=='Success') {
                    setTimeout(function () {
                        location.reload();
                    },200);
                }else{
                    alert('Failed');
                }
            }
        });
    });
})