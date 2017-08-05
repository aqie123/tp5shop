// 上传成功
// http://www.uploadify.com/documentation/uploadify/onuploadsuccess/

// http://www.uploadify.com/documentation/uploadify/filetypeexts/

$(function() {
    // 缩略图
    $("#file_upload").uploadify({
        'swf'             : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.image_upload,
        'buttonText'      : '图片上传',
        'fileTypeDesc' : 'Image Files',
        'fileObjName'  : 'file',
        'fileTypeExts' : '*.gif; *.jpg; *.png',
        'onUploadSuccess' : function(file, data, response) {
            console.log(file);
            console.log(data);
            console.log(response);
            if(response){
                var obj = JSON.parse(data);
                console.log(obj.data);
                $('#upload_org_code_img').attr("src",obj.data);
                $('#file_upload_image').attr("value",obj.data);
                $('#upload_org_code_img').show();
            }
        }
    });
    // 营业执照
    $("#file_upload_other").uploadify({
        'swf'             : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.image_upload,
        'buttonText'      : '图片上传',
        'fileTypeDesc' : 'Image Files',
        'fileObjName'  : 'file',
        'fileTypeExts' : '*.gif; *.jpg; *.png',
        'onUploadSuccess' : function(file, data, response) {
            if(response){
                var obj = JSON.parse(data);
                // console.log(obj.data);  文件路径
                $('#upload_org_code_img_other').attr("src",obj.data);
                $('#file_upload_image_other').attr("value",obj.data);
                $('#upload_org_code_img_other').show();
            }
        }
    });
});
// 编辑器自带图片上传
// /ueditor/php/upload/image/20170430/1493503076.jpg