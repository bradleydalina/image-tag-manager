t301.ready(function() {
    /* On window load */
    function strCapitalize(str){
        /* Capitalized Per Word */
        return str.replace(/\b(\w)/g, function (match) {
                return match.toUpperCase();
            });
    }
    function standardizedName(img){
        /* Transform image source filename into a valid title and alt tag value */
        let img_title = img.title;
        let img_alt = img.alt;
        let img_name = img.src;
                       //this removes the anchor at the end, if there is one
            img_name = img_name.substring(0, (img_name.indexOf("#" == -1) ? img_name.length : img_name.indexOf("#")));
                       //this removes the query after the file name, if there is one
            img_name = img_name.substring(0, (img_name.indexOf("?") == -1) ? img_name.length : img_name.indexOf("?"));
                       //this removes everything before the last slash in the path
            img_name = img_name.substring(img_name.lastIndexOf('/')+1);  //img.src.replace(/^.*[\\\/]/, '');

            img_name = (img_name.indexOf('.')!=-1) ? img_name.split('.').slice(0, -1).join('.') : img_name;
            if(parseInt(ITMplugin.options['strip_numbers'])==1){
                img_name= img_name.replace(/\s{0,}\d{1,}?\s{0,}x?\s{0,}\d{1,}?\s{0,}?/gmi, '');
                /* Remove any non-word chacacter accepts [a-zA-Z0-9]*/
                img_name= img_name.replace(/[0-9]/gmi, '');
            }
            img_name= img_name.replace(/[^\w]/gmi, ' ');
            /* Remove multiple underscore & hypens */
            img_name= img_name.replace(/\s*[-_\s]+\s*/gmi, ' ');
            /* Remove multiple spaces & tabs */
            img_name= img_name.replace(/\s\s+/gmi, ' ');
            /* Trim spaces in the start and end of string */
            img_name= img_name.trim();

            if(img_name.split("").length < 3){
                if(parseInt(ITMplugin.options['use_post_title_as_default'])==1){
                    if(ITMplugin.options['post_title']!==''){
                        img_name = ITMplugin.options['post_title'];
                    }
                    else{
                        img_name = ITMplugin.options['blog_name'];
                    }
                }
            }

            /* Verify title tag and replace with a valid title */
            if(img_title=== 'null' || img_title === 'undefined' || img_title===''){
                img.title = strCapitalize(img_name);
            }
            else if(strCapitalize(img_title)!=strCapitalize(img_name)){
                img.title = strCapitalize(img_name);
            }
            /* Verify alt tag and replace with a valid alt */
            if(img_alt === 'null' || img_alt === 'undefined' || img_alt===''){
                img.alt = strCapitalize(img_name);
            }
            else if(strCapitalize(img_alt)!=strCapitalize(img_name)){
                img.alt=strCapitalize(img_name);
            }
    }

    const images = t301.queries('img');
    if(images){
        /* Loop images and verify each */
        for(let x = 0; x < images.length; x++) {
            standardizedName(images[x]);
        }
    }
});
