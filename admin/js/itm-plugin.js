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
                       //this removes extension
            img_name = (img_name.indexOf('.')!=-1) ? img_name.split('.').slice(0, -1).join('.') : img_name;
            if(parseInt(ITMplugin.options['strip_numbers'])==1){
                img_name= img_name.replace(/\s?\d?\s?x?\s?\d?\s?/gmi, '');
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

            var image_alt_name=img_name;
            var image_title_name=img_name;

            if(parseInt(ITMplugin.options['add_post_title_to_alt'])==1){
                if(ITMplugin.options['post_title']!==''){
                    if(image_alt_name.indexOf(ITMplugin.options['post_title'])==-1){
                        image_alt_name += " - "+ITMplugin.options['post_title'];
                    }
                }
            }

            if(parseInt(ITMplugin.options['add_post_title_to_title'])==1){
                if(ITMplugin.options['post_title']!==''){
                    if(image_title_name.indexOf(ITMplugin.options['post_title'])==-1){
                        image_title_name += " - "+ITMplugin.options['post_title'];
                    }
                }
            }

            if(parseInt(ITMplugin.options['string_trimmer'])==1){
                let remove_from_alt = ITMplugin.options['remove_from_alt'];
                remove_from_alt = remove_from_alt.split(',');
                for(let i = 0; i < remove_from_alt.length; i++){
                    image_alt_name= image_alt_name.toLowerCase();
                    image_alt_name = image_alt_name.replace(remove_from_alt[i].trim().toLowerCase(),'');
                }
                let remove_from_title = ITMplugin.options['remove_from_title'];
                remove_from_title = remove_from_title.split(',');
                for(let i = 0; i < remove_from_title.length; i++){
                    image_title_name= image_title_name.toLowerCase();
                    image_title_name = image_title_name.replace(remove_from_title[i].trim().toLowerCase(), '');
                }
            }
            
            /* Verify title tag and replace with a valid title */
            if(img_title=== 'null' || img_title === 'undefined' || img_title===''){
                img.title = strCapitalize(image_title_name);
            }
            else if(strCapitalize(img_title)!=strCapitalize(image_title_name)){
                if(parseInt(ITMplugin.options['override_title'])==1){
                    img.title = strCapitalize(image_title_name);
                }else{
                    img.title = strCapitalize(img_title);
                }

            }
            /* Verify alt tag and replace with a valid alt */
            if(img_alt === 'null' || img_alt === 'undefined' || img_alt===''){
                img.alt = strCapitalize(image_alt_name);
            }
            else if(strCapitalize(img_alt)!=strCapitalize(image_alt_name)){
                if(parseInt(ITMplugin.options['override_alt'])==1){
                    img.alt=strCapitalize(image_alt_name);
                }else{
                    img.alt = strCapitalize(img_alt);
                }
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
