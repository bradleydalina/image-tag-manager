t301.ready(function(){
        //let annoying_notif_next = t301.id('screen-meta').nextElementSibling;
        let annoying_notif_list = t301.id('wpbody-content').children;//.nextElementSibling;
        if(annoying_notif_list){
            for(let i = 0; i < annoying_notif_list.length; i++){
                if(!annoying_notif_list[i].classList.contains('wrap') && !annoying_notif_list[i].classList.contains('clear') && !annoying_notif_list[i].classList.contains('metabox-prefs') && annoying_notif_list[i].id!='screen-meta-links'){
                    annoying_notif_list[i].remove();
                }
            }
        }
        if(t301.id('itm_add_class')){
            if(t301.id('itm_add_class').checked){
                t301.id('itm_add_class').parentNode.nextElementSibling.style.display='block';
            }
            else{
                t301.id('itm_add_class').parentNode.nextElementSibling.style.display='none';
            }
            t301.id('itm_add_class').addEventListener('change', function(event){
                if (event.target.checked){
                    t301.id('itm_add_class').parentNode.nextElementSibling.style.display='block';
                }
                else{
                    t301.id('itm_add_class').parentNode.nextElementSibling.style.display='none';
                }
            });
        }
        if(t301.id('itm_default_class')){
            t301.id('itm_default_class').value = t301.id('itm_default_class').value.replace(/[^a-z0-9-_\s]/gmi, '');
            t301.id('itm_default_class').value = t301.id('itm_default_class').value.replace(/\s\s+/g, ' ');
            t301.id('itm_default_class').addEventListener('input', function(event){
                t301.id('itm_default_class').value = this.value.replace(/[^a-z0-9-_\s]/gmi, '');
                t301.id('itm_default_class').value = this.value.replace(/\s\s+/g, ' ');
            });
        }

        if(t301.id('itm_string_trimmer')){
            if(t301.id('itm_string_trimmer').checked){
                t301.id('itm_remove_from_alt').parentNode.style.display='flex';
                t301.id('itm_remove_from_title').parentNode.style.display='flex';
            }
            else{
                t301.id('itm_remove_from_alt').parentNode.style.display='none';
                t301.id('itm_remove_from_title').parentNode.style.display='none';
            }
            t301.id('itm_string_trimmer').addEventListener('change', function(event){
                if (event.target.checked){
                    t301.id('itm_remove_from_alt').parentNode.style.display='flex';
                    t301.id('itm_remove_from_title').parentNode.style.display='flex';
                }
                else{
                    t301.id('itm_remove_from_alt').parentNode.style.display='none';
                    t301.id('itm_remove_from_title').parentNode.style.display='none';
                }
            });
        }

        if(t301.id('itm_clean_all')){
            if(t301.id('itm_clean_all').checked){
                t301.id('itm_strip_numbers').removeAttribute("disabled");
                t301.id('itm_use_post_title_as_default').removeAttribute("disabled");
            }
            t301.id('itm_clean_all').addEventListener('change', function(event){
                if (event.target.checked){
                    t301.id('itm_strip_numbers').removeAttribute("disabled");
                    t301.id('itm_use_post_title_as_default').removeAttribute("disabled");
                }
            });
        }
        if(t301.id('itm_preserved_all')){
            if(t301.id('itm_preserved_all').checked){
                t301.id('itm_strip_numbers').checked= false;
                t301.id('itm_strip_numbers').setAttribute("disabled", "disabled");
                t301.id('itm_use_post_title_as_default').checked=false;
                t301.id('itm_use_post_title_as_default').setAttribute("disabled", "disabled");
            }
            t301.id('itm_preserved_all').addEventListener('change', function(event){
                if (event.target.checked){
                    t301.id('itm_strip_numbers').checked= false;
                    t301.id('itm_strip_numbers').setAttribute("disabled", "disabled");
                    t301.id('itm_use_post_title_as_default').checked=false;
                    t301.id('itm_use_post_title_as_default').setAttribute("disabled", "disabled");
                }
            });
        }
        if(t301.id('itm_preserved_special')){
            if(t301.id('itm_preserved_special').checked){
                t301.id('itm_strip_numbers').removeAttribute("disabled");
                t301.id('itm_use_post_title_as_default').removeAttribute("disabled");
            }
            t301.id('itm_preserved_special').addEventListener('change', function(event){
                if (event.target.checked){
                    t301.id('itm_strip_numbers').removeAttribute("disabled");
                    t301.id('itm_use_post_title_as_default').removeAttribute("disabled");
                }
            });
        }

        if(t301.id('itm_remove_from_alt')){
            t301.id('itm_remove_from_alt').value = t301.id('itm_remove_from_alt').value.replace(/[^a-z0-9-_,\s]/gmi, '');
            t301.id('itm_remove_from_alt').value = t301.id('itm_remove_from_alt').value.replace(/\s,+/g, ', ');
            t301.id('itm_remove_from_alt').value = t301.id('itm_remove_from_alt').value.replace(/\s\s+/g, ' ');
            t301.id('itm_remove_from_alt').addEventListener('input', function(event){
                t301.id('itm_remove_from_alt').value = this.value.replace(/[^a-z0-9-_,\s]/gmi, '');
                t301.id('itm_remove_from_alt').value = this.value.replace(/\s,+/g, ', ');
                t301.id('itm_remove_from_alt').value = this.value.replace(/\s\s+/g, ' ');
            });
        }

        if(t301.id('itm_remove_from_title')){
            t301.id('itm_remove_from_title').value = t301.id('itm_remove_from_title').value.replace(/[^a-z0-9-_,\s]/gmi, '');
            t301.id('itm_remove_from_title').value = t301.id('itm_remove_from_title').value.replace(/\s,+/g, ', ');
            t301.id('itm_remove_from_title').value = t301.id('itm_remove_from_title').value.replace(/\s\s+/g, ' ');
            t301.id('itm_remove_from_title').addEventListener('input', function(event){
                t301.id('itm_remove_from_title').value = this.value.replace(/[^a-z0-9-_,\s]/gmi, '');
                t301.id('itm_remove_from_title').value = this.value.replace(/\s,+/g, ', ');
                t301.id('itm_remove_from_title').value = this.value.replace(/\s\s+/g, ' ');
            });
        }

        var submit_button = t301.id("itm-settings-submit");
        if(submit_button){
            submit_button.addEventListener("click", function(e){
                if(localStorage.getItem("itm_view")){
                    let saved_itm_view = JSON.parse(localStorage.getItem("itm_view"));
                    saved_itm_view['how_it_works']={"active_tab":saved_itm_view['plugin_settings'].active_tab};
                    localStorage.setItem("itm_view", JSON.stringify(saved_itm_view));
                }else{
                    localStorage.setItem("itm_view", JSON.stringify({['how_it_works']:{"active_tab":saved_itm_view['plugin_settings'].active_tab} }));
                }
            });
        }
        var success_update_notice = t301.query("span.success.notice.is-dismissible");
        var error_update_notice = t301.query("span.error.notice.is-dismissible");
        notice_clear(success_update_notice);
        notice_clear(error_update_notice);
        function notice_clear(notice){
            if(notice){
                setTimeout(function(){
                    notice.remove();
                }, 3000);
            }
        }

        var settings_tab = t301.queryall('.itm-settings-tab');
        if(settings_tab){
            var uri_query = window.location.search;
            var settings_view = "plugin-settings";
            if(uri_query){
                settings_view = (uri_query.match(/(<?view=)([a-zA-Z0-9-]+)/m)) ? uri_query.match(/(<?view=)([a-zA-Z0-9-]+)/m)[2] : settings_view;
                settings_view = settings_view.replace(/\-/gm, '_');
            }
            if(localStorage.getItem("itm_view")){
                let saved_itm_view = JSON.parse(localStorage.getItem("itm_view"));
                let itm_recently_save_settings = (localStorage.getItem("itm_recently_save_settings")) ? Boolean(localStorage.getItem("itm_recently_save_settings")) : false;
                let saved_settings_view = saved_itm_view[settings_view];
                if(saved_settings_view){
                    let active_tab_index = t301.id(saved_settings_view.active_tab);
                    if(saved_settings_view !='support' && settings_view !='support'){
                        if(itm_recently_save_settings){
                            if(settings_view == 'plugin_settings'){
                                if(saved_itm_view['how_it_works']){
                                    active_tab_index = t301.id(saved_itm_view['how_it_works'].active_tab);
                                }
                            }else{
                                if(saved_itm_view['plugin_settings']){
                                    active_tab_index = t301.id(saved_itm_view['plugin_settings'].active_tab);
                                }
                            }
                        }
                    }
                    if(active_tab_index){
                        clear_tabs(settings_tab, active_tab_index );
                        t301.id(active_tab_index.target.replace(/#/,'')).classList.remove("hide");
                        t301.id(active_tab_index.target.replace(/#/,'')).classList.add("show");
                        active_tab_index.classList.remove("inactive");
                        active_tab_index.classList.add("active");
                    }
                    else{
                        default_view();
                    }
                }
                else{
                    default_view();
                }
            }
            function default_view(){
                switch(settings_view)
                {
                    case "support":
                        active_tab_index = t301.id("issues-support");
                        break;
                    case "how_it_works":
                        active_tab_index = t301.id("basic-settings");
                        break;
                    default:
                        active_tab_index = t301.id("basic-settings");
                    break;
                }
                clear_tabs(settings_tab, active_tab_index );
                t301.id(active_tab_index.target.replace(/#/,'')).classList.remove("hide");
                t301.id(active_tab_index.target.replace(/#/,'')).classList.add("show");
                active_tab_index.classList.remove("inactive");
                active_tab_index.classList.add("active");
            }
            function clear_tabs(settings_tab, active_tab){
                for(let x =0; x < settings_tab.length; x++){
                    let settings_target_inner = settings_tab[x].getAttribute("target").replace(/#/,'');
                    if(settings_tab[x]!=active_tab){
                        t301.id(settings_target_inner).classList.remove("show");
                        t301.id(settings_target_inner).classList.add("hide");
                        settings_tab[x].classList.remove("active");
                        settings_tab[x].classList.add("inactive");
                    }
                }
            }

            for(let i =0; i < settings_tab.length; i++){
                var settings_target = settings_tab[i].getAttribute("target").replace(/#/,'');
                if(settings_tab[i].classList.contains("active")){
                    if(localStorage.getItem("itm_view")){
                        let saved_itm_view = JSON.parse(localStorage.getItem("itm_view"));
                        saved_itm_view[settings_view]={"active_tab":settings_tab[i].id};
                        localStorage.setItem("itm_view", JSON.stringify(saved_itm_view));
                    }else{
                        localStorage.setItem("itm_view", JSON.stringify({[settings_view]:{"active_tab":settings_tab[i].id} }));
                    }
                    t301.id(settings_target).classList.add("show");
                    t301.id(settings_target).classList.remove("hide");
                }else{
                    t301.id(settings_target).classList.add("hide");
                    t301.id(settings_target).classList.remove("show");
                }
                settings_tab[i].addEventListener('click', function(event){
                    clear_tabs(settings_tab, settings_tab[i]);
                    if(!this.classList.contains("active")){
                        if(localStorage.getItem("itm_view")){
                            let saved_itm_view = JSON.parse(localStorage.getItem("itm_view"));
                            saved_itm_view[settings_view]={"active_tab":this.id};
                            localStorage.setItem("itm_view", JSON.stringify(saved_itm_view));
                        }else{
                            localStorage.setItem("itm_view", JSON.stringify({[settings_view]:{"active_tab":this.id} }));
                        }
                        t301.id(this.target.replace(/#/,'')).classList.remove("hide");
                        t301.id(this.target.replace(/#/,'')).classList.add("show");
                        this.classList.remove("inactive");
                        this.classList.add("active");
                    }
                });
            }
        }
    }
);
