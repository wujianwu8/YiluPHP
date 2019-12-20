/*
 * 使用RSA方法加密某个对象中的指定值
 * @param object objData 包含键值对的对象
 * @param array field 需要加密的键名
 * @return object 返回加密后的objData对象
 * */
function rsaEncryptData(objData, field){
    var encrypt = new JSEncrypt();
    encrypt.setPublicKey(rsaPublicKey);
    for(var i in field){
        if(objData[field[i]]!==undefined && objData[field[i]]!==null){
            objData[field[i]] = encrypt.encrypt(objData[field[i]]);
            objData[field[i]] = encodeURI(objData[field[i]]).replace(/\+/g, '%2B');
        }
    }
    return objData;
}

/*
 * 切换当前系统语言
 * @param string lang 语言的编码，如cn为中文，en为英文，其它开发者可定义
 * @return 跳转页面
 * */
function changeLanguage(lang)
{
    if (lang=="selected"){
        return false;
    }
    url = document.location.href;
    tmp = url.split("#");
    tmp2 = tmp[0].split("?");
    args = getUrlParms();
    args.lang = lang;
    params = [];
    for (var i in args){
        params.push(i+"="+args[i]);
    }
    url = tmp2[0] + "?" + params.join("&");
    if (tmp.length>1){
        url += "#"+tmp[1];
    }
    document.location.href = url;
}

/*
 * 根据语言键名和参数返回当前语言类型下的翻译文本
 * @param string key 语言键名
 * @param object param 翻译里的变量参数及值，如果没有可以不传此参数
 * @return string 返回 当前语言类型下的翻译文本
 * */
function getLang(key, param)
{
    if (typeof language == "object"){
        if (typeof language[key] == "string"){
            key = language[key];
            if (typeof param == "object"){
                $.each(param, function (index, value) {
                    // alert(typeof value.values)
                    if (typeof value == "object" && typeof value.value!="undefined"){
                        if (value.value<=1){
                            reg = new RegExp("<--singular(.*?)\\{\\$"+index+"\\}(.*?)-->", "g");
                            key= key.replace(reg, "$1"+value.value+"$2");
                            reg = new RegExp("<--plural(.*?)\\{\\$"+index+"\\}(.*?)-->", "g");
                            key= key.replace(reg, "");
                        }
                        else{
                            reg = new RegExp("<--plural(.*?)\\{\\$"+index+"\\}(.*?)-->", "g");
                            key= key.replace(reg, "$1"+value.value+"$2");
                            reg = new RegExp("<--singular(.*?)\\{\\$"+index+"\\}(.*?)-->", "g");
                            key= key.replace(reg, "");
                        }
                        reg = new RegExp("\\{\\$"+index+"\\}", "g");
                        key= key.replace(reg, value.value);
                    }
                    else {
                        reg = new RegExp("\\{\\$"+index+"\\}", "g");
                        key= key.replace(reg, value);
                    }
                });
            }
        }
    }
    return key;
}

