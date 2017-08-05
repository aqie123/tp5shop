/*系统-栏目-添加*/
function system_category_add(title,url,w,h){
    layer_show(title,url,w,h);
}
/*系统-栏目-编辑*/
function system_category_edit(title,url,id,w,h){
    layer_show(title,url,w,h);
}
/*系统-栏目-删除*/
function system_category_del(url){
    layer.confirm('确认要删除吗？',function(index){
        window.location.href = url;
    });
}
// 排序框失焦触发事件(category,)
$('.listorder input').blur(function(){

    // 排序id
    var id = $(this).attr('attr-id');
    // 填写的排序
    var listorder = $(this).val();
    var postData = {
        'id' : id,
        'listorder' : listorder
    }
    var url = SCOPE.listorder_url;
    // ajax 传送信息
    $.post(url,postData,function(result){
        if(result.code == 1){
            location.href = result.data;
        }else{
            alert(result.msg);
        }
    },"json");
});
/**
 * 点击城市获取二级城市
 */
 $(".cityId").change(function(){
     city_id = $(this).val();
     url = SCOPE.city_url;
     postData = {'id':city_id};
    // 抛出请求
     $.post(url,postData,function(result){
        // todo
         if(result.status == 1){
            // 将信息填充到变量
             // [{id: 13, name: "吉安", uname: "jian", parent_id: 4, listorder: 0, status: 1,…},…]
             data = result.data;
             city_html = "";
             $(data).each(function(){
                city_html += "<option value='"+this.id+"'>"+this.name+"</option>>";
             });
             $('.se_city_id').html(city_html);

         }else if(result.status == 0){
            // alert(result.message);
             $('.se_city_id').html('');
            return;
         }
     },"json");
 });

/**
 *获取商户入驻申请分类的子类
 */
$(".categoryId").change(function(){
    category_id = $(this).val();
    url = SCOPE.category_url;
    postData = {'id':category_id};
    // 抛出请求
    $.post(url,postData,function(result){
        // todo
        if(result.status == 1){
            // 将信息填充到变量
            data = result.data;
            category_html = "";
            $(data).each(function(){
                category_html += '<input name="sec_category_id[]" type="checkbox" id="checkbox-mobnan"\
                                value="'+this.id+'"/>'+this.name;
                category_html += '<label for="checkbox-moban">&nbsp;</label>';
            });
            $('.se_category_id').html(category_html);

        }else if(result.status == 0){
            $('.se_category_id').html('');
            // alert(result.message);
            return;
        }
    },"json");
});