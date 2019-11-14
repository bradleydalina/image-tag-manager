t301.ready(function() {
    function strCapitalize(str){
        return str.replace(/\b(\w)/g, function (match) {
                return match.toUpperCase();
            });
    }
    function standardizedName(img,type){
                        //this removes the anchor at the end, if there is one
        var img_name = img.src.substring(0, (img.src.indexOf("#") == -1) ? img.src.length : img.src.indexOf("#"));
                       //this removes the query after the file name, if there is one
            img_name = img_name.substring(0, (img_name.indexOf("?") == -1) ? img_name.length : img_name.indexOf("?"));
                       //this removes everything before the last slash in the path
            img_name = img_name.substring(img_name.lastIndexOf('/')+1);  //img.src.replace(/^.*[\\\/]/, '');

            img_name = (img_name.indexOf('.')!=-1) ? img_name.split('.').slice(0, -1).join('.') : img_name;
            if(parseInt(ITMsettings.options['strip_numbers'])==1){
                img_name= img_name.replace(/\s{0,}\d{1,}?\s{0,}x?\s{0,}\d{1,}?\s{0,}?/gmi, '');
                /* Remove any non-word chacacter accepts [a-zA-Z0-9]*/
                img_name= img_name.replace(/[0-9]/gmi, '');
                img_name= img_name.replace(/[^\w]/gmi, ' ');
                /* Remove multiple underscore & hypens */
                img_name= img_name.replace(/\s*[-_\s]+\s*/gmi, ' ');
                /* Remove multiple spaces & tabs */
                img_name= img_name.replace(/\s\s+/gmi, ' ');
                /* Trim spaces in the start and end of string */
                img_name= img_name.trim();
            }

            if(img_name.split("").length < 3){
                if(parseInt(ITMsettings.options['use_post_title_as_default'])==1){
                    if(ITMsettings.options['post_title']!==''){
                        img_name = ITMsettings.options['post_title'];
                    }
                    else{
                        img_name = ITMsettings.options['blog_name'];
                    }
                }
            }
            if(type=='title'){
                if(img.getAttribute("title") === 'null' || img.getAttribute("title") === 'undefined' || img.getAttribute("title")===''){
                    img.setAttribute("title", img_name);
                }
                else if(img.getAttribute("title")!=strCapitalize(img_name)){
                    img.setAttribute("title", strCapitalize(img_name));
                }
            }
            if(type=='alt'){
                if(img.getAttribute("alt") === 'null' || img.getAttribute("alt") === 'undefined' || img.getAttribute("alt")===''){
                    img.setAttribute("alt", img_name);
                }
                else if(img.getAttribute("alt")!=strCapitalize(img_name)){
                    img.setAttribute("alt", strCapitalize(img_name));
                }
            }
    }

    const images = t301.tags('img');
    if(images){
        for(let x = 0; x < images.length; x++) {
            standardizedName(images[x], 'title');
            standardizedName(images[x], 'alt');
        }
    }
});
