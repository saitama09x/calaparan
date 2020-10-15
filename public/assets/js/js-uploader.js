
function fileupload(uploader){
  var api = new API();

  var loading = $(".pp-loading");  
  uploader.on('fileuploadadd', function (e, data) {
      $.each(data.files, function (index, file) {
          if(index == 0){
              var form_group = $("<div>");
              form_group.addClass("form-group mt-2")
              var progwrap = $("<p>");
              progwrap.text("0%")
              form_group.html(progwrap)
              loading.html(form_group)
              var current_index = form_group.get();
              data.formData = { 
                  "current_index" : current_index
               }

             data.submit();
          }
          else{
            data.abort();
          }
      })
  })


uploader.on('fileuploadprogress', function (e, data) { 
    var current = data.formData['current_index'];
    var progress = parseInt(data.loaded / data.total * 100, 10);
    $(current).find('p').text(progress + '%');
})

uploader.on('fileuploaddone', function (e, data) {
    var file_preview = data.result.files[0];
 
    var img = $(".card-img-top");
    img.attr({ src : 'http://calaparan.xpsjobs.ph/' + file_preview.url});

    api.update_profile_pic({ picture : file_preview.name }, function(res){
          
    });

})

}