t301.ready(function(){
        if(t301.id('add_class')){
            if(t301.id('add_class').checked){
                t301.id('default_class').parentNode.style.display='flex';
            }
            else{
                t301.id('default_class').parentNode.style.display='none';
            }
            t301.id('add_class').addEventListener('change', function(event){
                if (event.target.checked){
                    t301.id('default_class').parentNode.style.display='flex';
                }
                else{
                    t301.id('default_class').parentNode.style.display='none';
                }
            });
        }
        if(t301.id('default_class')){
            t301.id('default_class').value = t301.id('default_class').value.replace(/[^a-z0-9-_\s]/gmi, '');
            t301.id('default_class').value = t301.id('default_class').value.replace(/\s\s+/g, ' ');
            t301.id('default_class').addEventListener('input', function(event){
                t301.id('default_class').value = this.value.replace(/[^a-z0-9-_\s]/gmi, '');
                t301.id('default_class').value = this.value.replace(/\s\s+/g, ' ');
            });
        }

        if(t301.id('string_trimmer')){
            if(t301.id('string_trimmer').checked){
                t301.id('remove_from_alt').parentNode.style.display='flex';
                t301.id('remove_from_title').parentNode.style.display='flex';
            }
            else{
                t301.id('remove_from_alt').parentNode.style.display='none';
                t301.id('remove_from_title').parentNode.style.display='none';
            }
            t301.id('string_trimmer').addEventListener('change', function(event){
                if (event.target.checked){
                    t301.id('remove_from_alt').parentNode.style.display='flex';
                    t301.id('remove_from_title').parentNode.style.display='flex';
                }
                else{
                    t301.id('remove_from_alt').parentNode.style.display='none';
                    t301.id('remove_from_title').parentNode.style.display='none';
                }
            });
        }

        if(t301.id('remove_from_alt')){
            t301.id('remove_from_alt').value = t301.id('remove_from_alt').value.replace(/[^a-z0-9-_,\s]/gmi, '');
            t301.id('remove_from_alt').value = t301.id('remove_from_alt').value.replace(/\s,+/g, ', ');
            t301.id('remove_from_alt').value = t301.id('remove_from_alt').value.replace(/\s\s+/g, ' ');
            t301.id('remove_from_alt').addEventListener('input', function(event){
                t301.id('remove_from_alt').value = this.value.replace(/[^a-z0-9-_,\s]/gmi, '');
                t301.id('remove_from_alt').value = this.value.replace(/\s,+/g, ', ');
                t301.id('remove_from_alt').value = this.value.replace(/\s\s+/g, ' ');
            });
        }

        if(t301.id('remove_from_title')){
            t301.id('remove_from_title').value = t301.id('remove_from_title').value.replace(/[^a-z0-9-_,\s]/gmi, '');
            t301.id('remove_from_title').value = t301.id('remove_from_title').value.replace(/\s,+/g, ', ');
            t301.id('remove_from_title').value = t301.id('remove_from_title').value.replace(/\s\s+/g, ' ');
            t301.id('remove_from_title').addEventListener('input', function(event){
                t301.id('remove_from_title').value = this.value.replace(/[^a-z0-9-_,\s]/gmi, '');
                t301.id('remove_from_title').value = this.value.replace(/\s,+/g, ', ');
                t301.id('remove_from_title').value = this.value.replace(/\s\s+/g, ' ');
            });
        }


    }
);
